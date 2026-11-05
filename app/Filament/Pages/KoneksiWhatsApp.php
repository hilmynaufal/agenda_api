<?php

namespace App\Filament\Pages;

use App\Services\EvolutionService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class KoneksiWhatsApp extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qrcode';

    protected static ?string $navigationGroup = 'Agenda';

    protected static ?string $navigationLabel = 'Koneksi WhatsApp';

    protected static string $view = 'filament.pages.koneksi-whatsapp';

    protected static ?string $title = 'Koneksi WhatsApp';

    public string $state = 'unknown';

    public ?string $qr = null;

    public ?string $pairingCode = null;

    public ?string $nomor = null;

    public function mount(): void
    {
        $this->refreshState();
    }

    protected function evolution(): EvolutionService
    {
        return new EvolutionService();
    }

    public function getConfiguredProperty(): bool
    {
        return $this->evolution()->configured();
    }

    public function getInstanceNameProperty(): string
    {
        return $this->evolution()->instanceName();
    }

    public function getDriverAktifProperty(): string
    {
        return config('services.wa_driver') === 'evolution' ? 'Evolution API' : 'Fonnte';
    }

    /** Dipanggil juga oleh wire:poll saat menunggu QR dipindai. */
    public function refreshState(): void
    {
        if (!$this->configured) {
            $this->state = 'unconfigured';
            return;
        }

        $this->state = $this->evolution()->state();

        if ($this->state === 'open') {
            $this->qr = null;
            $this->pairingCode = null;
        }
    }

    public function buatInstance(): void
    {
        [$ok, $pesan] = $this->evolution()->create();

        $this->notif($ok, 'Instance berhasil dibuat', $pesan);
        $this->hubungkan();
    }

    public function hubungkan(): void
    {
        $this->refreshState();

        if ($this->state === 'open') {
            $this->notif(true, 'WhatsApp sudah terhubung');
            return;
        }

        if ($this->state === 'not_found') {
            $this->notif(false, 'Instance belum dibuat', 'Klik "Buat Instance" terlebih dahulu.');
            return;
        }

        if (blank(preg_replace('/\D/', '', (string) $this->nomor))) {
            $this->notif(false, 'Nomor belum diisi', 'Isi nomor WhatsApp yang akan dihubungkan.');
            return;
        }

        $hasil = $this->evolution()->qr($this->nomor);

        $this->qr = $hasil['base64'] ?? null;
        $this->pairingCode = $hasil['pairingCode'] ?? null;

        if ($this->qr === null && $this->pairingCode === null) {
            $this->notif(false, 'QR belum tersedia', 'Coba lagi beberapa detik lagi.');
        }
    }

    public function restart(): void
    {
        [$ok, $pesan] = $this->evolution()->restart();
        $this->notif($ok, 'Instance di-restart', $pesan);
        $this->refreshState();
    }

    public function putuskan(): void
    {
        [$ok, $pesan] = $this->evolution()->logout();
        $this->qr = null;
        $this->notif($ok, 'WhatsApp diputuskan', $pesan);
        $this->refreshState();
    }

    public function hapusInstance(): void
    {
        [$ok, $pesan] = $this->evolution()->delete();
        $this->qr = null;
        $this->notif($ok, 'Instance dihapus', $pesan);
        $this->refreshState();
    }

    protected function notif(bool $ok, string $judul, ?string $pesan = null): void
    {
        $n = Notification::make()->title($ok ? $judul : 'Gagal: ' . $judul);

        if (!$ok && $pesan) {
            $n->body($pesan);
        }

        $ok ? $n->success()->send() : $n->danger()->send();
    }
}
