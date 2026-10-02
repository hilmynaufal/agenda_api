<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaTemplate extends Model
{
    protected $table = 't_wa_template';
    protected $primaryKey = 'id';

    protected $fillable = [
        'header',
        'body',
        'footer',
    ];

    public const DEFAULT_HEADER = "Yth. {{nama_pendamping}}\n\nAnda ditunjuk sebagai perwakilan untuk menghadiri agenda berikut:";

    public const DEFAULT_BODY = <<<'TEXT'
{{tanggal}}
{{waktu}}
{{acara}}
di {{tempat}}
LS: {{leading_sektor}}
Pendamping:
{{nama_pendamping}}
Pakaian:
{{pakaian}}
Catatan:
{{catatan}}
TEXT;

    public const DEFAULT_FOOTER = "Mohon konfirmasi kehadiran. Terima kasih.";

    /**
     * Baris tunggal pengaturan template -- selalu ambil baris pertama, atau
     * instance baru (belum disimpan) berisi default kalau admin belum pernah
     * menyimpan pengaturan sama sekali.
     */
    public static function current(): self
    {
        return static::query()->first() ?? new static([
            'header' => self::DEFAULT_HEADER,
            'body' => self::DEFAULT_BODY,
            'footer' => self::DEFAULT_FOOTER,
        ]);
    }

    /**
     * Daftar token yang boleh dipakai admin di header/isi/footer, beserta
     * penjelasannya -- dipakai di halaman pengaturan sebagai cheat-sheet.
     * Token yang tidak punya nilai (mis. agenda tanpa pakaian) diganti "-".
     */
    public static function tokenLabels(): array
    {
        return [
            '{{nama_pendamping}}' => 'Nama pendamping/perwakilan',
            '{{acara}}' => 'Nama acara',
            '{{tanggal}}' => 'Tanggal agenda, mis. "Rabu, 16 Sep 2026"',
            '{{waktu}}' => 'Jam mulai, mis. "13:00"',
            '{{tempat}}' => 'Lokasi acara',
            '{{leading_sektor}}' => 'Leading sektor / OPD penanggung jawab',
            '{{pakaian}}' => 'Ketentuan pakaian',
            '{{catatan}}' => 'Keterangan tambahan agenda',
        ];
    }
}
