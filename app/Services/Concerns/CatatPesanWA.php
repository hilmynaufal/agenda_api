<?php

namespace App\Services\Concerns;

use App\Models\WaLog;
use Illuminate\Support\Facades\Log;

trait CatatPesanWA
{
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
            Log::error('WA: gagal mencatat log pengiriman', ['error' => $e->getMessage()]);
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
