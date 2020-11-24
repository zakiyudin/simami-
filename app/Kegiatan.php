<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'jenis_kegiatan_id',
        'penceramah_id'
    ];

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class);
    }

    public function penceramah()
    {
        return $this->belongsTo(Penceramah::class);
    }
}
