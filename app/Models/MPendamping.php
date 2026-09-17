<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPendamping extends Model
{
    protected $table = 'm_pendamping';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'jabatan',
        'no_hp',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
