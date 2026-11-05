<?php

namespace App\Services;

use App\Services\Concerns\CatatPesanWA;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EvolutionService
{
    use CatatPesanWA;

    protected string $baseUrl;
    protected ?string $apiKey;
    protected string $instance;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.evolution.url'), '/');
        $this->apiKey = config('services.evolution.api_key');
        $this->instance = (string) config('services.evolution.instance');
    }

    public function instanceName(): string
    {
        return $this->instance;
    }

    public function configured(): bool
    {
        return $this->baseUrl !== '' && !empty($this->apiKey) && $this->instance !== '';
    }

    public function send(string $noHp, string $message, array $context = []): bool
    {
        $target = $this->normalizePhone($noHp);

        if ($target === null) {
            Log::warning('Evolution: nomor HP tidak valid, pesan tidak dikirim', ['no_hp' => $noHp]);
            $this->catat($context, $noHp, $message, false, 'Nomor HP tidak valid');
            return false;
        }

        try {
            $response = $this->http()->post("/message/sendText/{$this->instance}", [
                'number' => $target,
                'text' => $message,
            ]);

            if (!$response->successful()) {
                Log::error('Evolution: gagal mengirim WhatsApp', [
                    'target' => $target,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                $this->catat($context, $target, $message, false, $response->body());
                return false;
            }

            $this->catat($context, $target, $message, true, $response->body());
            return true;
        } catch (\Throwable $e) {
            Log::error('Evolution: exception saat mengirim WhatsApp', [
                'target' => $target,
                'error' => $e->getMessage(),
            ]);
            $this->catat($context, $target, $message, false, $e->getMessage());
            return false;
        }
    }

    /**
     * Status koneksi: open | connecting | close | not_found | error.
     */
    public function state(): string
    {
        try {
            $response = $this->http()->get("/instance/connectionState/{$this->instance}");

            if ($response->status() === 404) {
                return 'not_found';
            }

            return $response->successful()
                ? (string) data_get($response->json(), 'instance.state', 'close')
                : 'error';
        } catch (\Throwable $e) {
            Log::error('Evolution: gagal membaca status', ['error' => $e->getMessage()]);
            return 'error';
        }
    }

    /**
     * Buat instance baru. Mengembalikan [berhasil, pesan].
     */
    public function create(): array
    {
        // Nomor sengaja tidak dikirim di sini: /instance/create menolak format +62.
        // Nomor hanya dipakai saat connect.
        return $this->aksi(fn () => $this->http()->post('/instance/create', [
            'instanceName' => $this->instance,
            'qrcode' => true,
            'integration' => 'WHATSAPP-BAILEYS',
        ]));
    }

    /**
     * Minta QR code. Mengembalikan ['base64' => ..., 'pairingCode' => ...],
     * atau null bila gagal / instance sudah tersambung.
     */
    public function qr(?string $nomor = null): ?array
    {
        try {
            $response = $this->http()->get("/instance/connect/{$this->instance}", array_filter(["number" => $this->nomorDenganPlus($nomor)]));
            $base64 = $response->json('base64');

            if (!$response->successful() || (empty($base64) && empty($response->json("pairingCode")))) {
                return null;
            }

            return ['base64' => $base64, 'pairingCode' => $response->json('pairingCode')];
        } catch (\Throwable $e) {
            Log::error('Evolution: gagal meminta QR', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function restart(): array
    {
        return $this->aksi(fn () => $this->http()->post("/instance/restart/{$this->instance}"));
    }

    public function logout(): array
    {
        return $this->aksi(fn () => $this->http()->delete("/instance/logout/{$this->instance}"));
    }

    public function delete(): array
    {
        return $this->aksi(fn () => $this->http()->delete("/instance/delete/{$this->instance}"));
    }

    /** Format untuk koneksi instance: selalu +62..., contoh 08123 → +628123. */
    protected function nomorDenganPlus(?string $nomor): ?string
    {
        $normal = $this->normalizePhone($nomor);

        return $normal === null ? null : '+' . $normal;
    }

    protected function aksi(\Closure $request): array
    {
        try {
            $response = $request();

            if ($response->successful()) {
                return [true, 'Berhasil'];
            }

            $pesan = $response->json('response.message.0') ?? $response->json('message') ?? $response->body();

            return [false, is_string($pesan) ? $pesan : json_encode($pesan)];
        } catch (\Throwable $e) {
            return [false, $e->getMessage()];
        }
    }

    protected function http(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withHeaders(['apikey' => (string) $this->apiKey])
            ->acceptJson()
            ->timeout(20);
    }
}
