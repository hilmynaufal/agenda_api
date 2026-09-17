<?php

namespace App\Services;

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

    public function send(string $noHp, string $message): bool
    {
        $target = $this->normalizePhone($noHp);

        if ($target === null) {
            Log::warning('Fonnte: nomor HP tidak valid, pesan tidak dikirim', ['no_hp' => $noHp]);
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
                return false;
            }

            $body = $response->json();
            if (isset($body['status']) && $body['status'] === false) {
                Log::error('Fonnte: API menolak pesan', ['target' => $target, 'response' => $body]);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('Fonnte: exception saat mengirim WhatsApp', [
                'target' => $target,
                'error' => $e->getMessage(),
            ]);
            return false;
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
