<?php

namespace App\Services;

use App\Services\Concerns\CatatPesanWA;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    use CatatPesanWA;

    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
        $this->url = config('services.fonnte.url');
    }

    public function send(string $noHp, string $message, array $context = []): bool
    {
        $target = $this->normalizePhone($noHp);

        if ($target === null) {
            Log::warning('Fonnte: nomor HP tidak valid, pesan tidak dikirim', ['no_hp' => $noHp]);
            $this->catat($context, $noHp, $message, false, 'Nomor HP tidak valid');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->url, [
                'target' => $target,
                'message' => $message,
            ]);

            if (!$response->successful()) {
                Log::error('Fonnte: gagal mengirim WhatsApp', [
                    'target' => $target,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                $this->catat($context, $target, $message, false, $response->body());
                return false;
            }

            $body = $response->json();
            if (isset($body['status']) && $body['status'] === false) {
                Log::error('Fonnte: API menolak pesan', ['target' => $target, 'response' => $body]);
                $this->catat($context, $target, $message, false, $response->body());
                return false;
            }

            $this->catat($context, $target, $message, true, $response->body());
            return true;
        } catch (\Throwable $e) {
            Log::error('Fonnte: exception saat mengirim WhatsApp', [
                'target' => $target,
                'error' => $e->getMessage(),
            ]);
            $this->catat($context, $target, $message, false, $e->getMessage());
            return false;
        }
    }
}
