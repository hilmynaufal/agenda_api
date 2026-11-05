<?php

namespace App\Services;

class WhatsAppService
{
    /**
     * Pengirim WhatsApp aktif sesuai WA_DRIVER (evolution | fonnte).
     */
    public static function make(): EvolutionService|FonnteService
    {
        return config('services.wa_driver') === 'evolution'
            ? new EvolutionService()
            : new FonnteService();
    }
}
