<?php

namespace App\Services;

use App\Models\WaLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
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

    protected function catat(array $context, ?string $noHp, string $message, bool $status, ?string $response): void
    {
        try {
            WaLog::create([
                'agenda_id' => $context['agenda_id'] ?? null,
                'pendamping_id' => $context['pendamping_id'] ?? null,
                'nama_pendamping' => $context['nama_pendamping'] ?? null,
                'no_hp' => $noHp,
                'pesan' => $message,
                'status' => $status,
                'response' => $response,
            ]);
        } catch (\Throwable $e) {
            Log::error('Fonnte: gagal mencatat log pengiriman', ['error' => $e->getMessage()]);
        }
    }

    protected function normalizePhone(?string $noHp): ?string
    {
        if (empty($noHp)) {
            return null;
        }

        $digits = preg_replace('/\D/', '', $noHp);

        if ($digits === '') {
            return null;
        }

        if (substr($digits, 0, 1) === '0') {
            $digits = '62' . substr($digits, 1);
        } elseif (substr($digits, 0, 2) !== '62') {
            $digits = '62' . $digits;
        }

        return $digits;
    }
}
