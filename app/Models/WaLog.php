<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaLog extends Model
{
    protected $table = 't_wa_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
        'pendamping_id',
        'nama_pendamping',
        'no_hp',
        'pesan',
        'status',
        'response',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function agenda()
    {
        return $this->belongsTo(MAgenda::class, 'agenda_id');
    }

    public function pendamping()
    {
        return $this->belongsTo(MPendamping::class, 'pendamping_id');
    }
}
