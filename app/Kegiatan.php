<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'penceramah_id',
        'jenis_kegiatan_id',
    ];
}
