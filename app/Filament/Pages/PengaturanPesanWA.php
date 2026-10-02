<?php

namespace App\Filament\Pages;

use App\Http\Controllers\Api\ApiController;
use App\Models\MPendamping;
use App\Models\WaTemplate;
use App\Services\FonnteService;
use Closure;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\HtmlString;

class PengaturanPesanWA extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Agenda';

    protected static ?string $navigationLabel = 'Pengaturan Pesan WA';

    protected static string $view = 'filament.pages.pengaturan-pesan-w-a';

    protected static ?string $title = 'Pengaturan Pesan WhatsApp';

    public ?array $data = [];

    public function mount(): void
    {
        $template = WaTemplate::current();

        $this->form->fill([
            'header' => $template->header ?: WaTemplate::DEFAULT_HEADER,
            'body' => $template->body ?: WaTemplate::DEFAULT_BODY,
            'footer' => $template->footer ?: WaTemplate::DEFAULT_FOOTER,
            'pendamping_test_id' => null,
        ]);
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        $daftarToken = collect(WaTemplate::tokenLabels())
            ->map(fn ($label, $token) => "<code>{$token}</code> — {$label}")
            ->implode('<br>');

        return [
            Forms\Components\Section::make('Template Pesan')
                ->description('Header, isi, dan footer semuanya bebas diedit dan boleh memakai token seperti {{acara}} atau {{pakaian}}. Boleh dikosongkan untuk pakai bawaan sistem.')
                ->schema([
                    Forms\Components\Textarea::make('header')
                        ->label('Header')
                        ->rows(4)
                        ->reactive()
                        ->placeholder(WaTemplate::DEFAULT_HEADER),
                    Forms\Components\Textarea::make('body')
                        ->label('Isi')
                        ->helperText('Detail agenda. Tiap baris bebas ditulis ulang, mis. "Diharap menggunakan pakaian {{pakaian}} untuk acara tersebut".')
                        ->rows(10)
                        ->reactive()
                        ->placeholder(WaTemplate::DEFAULT_BODY),
                    Forms\Components\Textarea::make('footer')
                        ->label('Footer')
                        ->rows(3)
                        ->reactive()
                        ->placeholder(WaTemplate::DEFAULT_FOOTER),
                    Forms\Components\Placeholder::make('token_help')
                        ->label('Token yang bisa dipakai di Header/Isi/Footer')
                        ->content(new HtmlString($daftarToken)),
                ]),

            Forms\Components\Section::make('Pratinjau')
                ->description('Contoh hasil jadi memakai data agenda contoh, mengikuti isian di atas secara langsung.')
                ->schema([
                    Forms\Components\Placeholder::make('preview')
                        ->label(null)
                        ->content(function (Closure $get) {
                            $pesan = $this->rangkaiPesanContoh('Budi Santoso', $get('header'), $get('body'), $get('footer'));

                            return new HtmlString(
                                '<pre class="whitespace-pre-wrap text-sm bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border">' . e($pesan) . '</pre>'
                            );
                        }),
                ]),

            Forms\Components\Section::make('Kirim Contoh')
                ->description('Kirim pesan pratinjau di atas ke salah satu pendamping terdaftar, untuk cek tampilan asli di WhatsApp.')
                ->schema([
                    Forms\Components\Select::make('pendamping_test_id')
                        ->label('Kirim ke')
                        ->options(fn () => MPendamping::where('aktif', true)->pluck('nama', 'id'))
                        ->placeholder('Pilih pendamping...'),
                ]),
        ];
    }

    protected function agendaContoh(): object
    {
        return (object) [
            'acara' => 'Rapat Koordinasi Contoh',
            'tempat' => 'Ruang Rapat Bupati',
            'tanggal_mulai' => now()->addDays(3)->format('Y-m-d'),
            'waktu_mulai' => now()->addDays(3)->format('Y-m-d') . ' 09:00:00.000000',
            'leading_sektor' => 'Sekretariat Daerah',
            'pakaian' => 'PSL',
            'keterangan_tambahan' => 'Contoh keterangan tambahan agenda.',
        ];
    }

    /**
     * Rangkai pesan lengkap (header + isi + footer) memakai data agenda
     * contoh -- dipakai bareng oleh Pratinjau (live, dari form state) dan
     * Kirim Contoh (dari state yang sudah disubmit).
     */
    protected function rangkaiPesanContoh(string $namaPendamping, ?string $header, ?string $body, ?string $footer): string
    {
        $controller = new ApiController();
        $buatToken = new \ReflectionMethod($controller, 'buatTokenPesan');
        $buatToken->setAccessible(true);

        $token = $buatToken->invoke($controller, $namaPendamping, $this->agendaContoh());

        $headerJadi = trim(strtr($header ?: WaTemplate::DEFAULT_HEADER, $token));
        $bodyJadi = trim(strtr($body ?: WaTemplate::DEFAULT_BODY, $token));
        $footerJadi = trim(strtr($footer ?: WaTemplate::DEFAULT_FOOTER, $token));

        return implode("\n\n", array_filter([$headerJadi, $bodyJadi, $footerJadi], fn ($b) => $b !== ''));
    }

    protected function getActions(): array
    {
        return [
            Action::make('kirimContoh')
                ->label('Kirim Contoh')
                ->color('secondary')
                ->icon('heroicon-o-paper-airplane')
                ->action('kirimContoh'),
            Action::make('save')
                ->label('Simpan')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $template = WaTemplate::current();
        $template->header = $state['header'] ?: null;
        $template->body = $state['body'] ?: null;
        $template->footer = $state['footer'] ?: null;
        $template->save();

        Notification::make()
            ->title('Template pesan berhasil disimpan')
            ->success()
            ->send();
    }

    public function kirimContoh(): void
    {
        $state = $this->form->getState();
        $pendampingId = $state['pendamping_test_id'] ?? null;

        if (!$pendampingId) {
            Notification::make()
                ->title('Pilih pendamping dulu untuk kirim contoh')
                ->warning()
                ->send();

            return;
        }

        $pendamping = MPendamping::find($pendampingId);

        if ($pendamping === null || empty($pendamping->no_hp)) {
            Notification::make()
                ->title('Nomor HP pendamping tidak ditemukan')
                ->danger()
                ->send();

            return;
        }

        $pesan = $this->rangkaiPesanContoh(
            $pendamping->nama,
            $state['header'] ?? null,
            $state['body'] ?? null,
            $state['footer'] ?? null,
        );

        $berhasil = (new FonnteService())->send($pendamping->no_hp, $pesan, [
            'pendamping_id' => $pendamping->id,
            'nama_pendamping' => $pendamping->nama,
        ]);

        Notification::make()
            ->title($berhasil ? 'Contoh pesan berhasil dikirim' : 'Gagal mengirim contoh pesan')
            ->body($berhasil ? "Terkirim ke {$pendamping->nama}" : 'Cek menu Log Notifikasi WA untuk detail error.')
            ->status($berhasil ? 'success' : 'danger')
            ->send();
    }
}
