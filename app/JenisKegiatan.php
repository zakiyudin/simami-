<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    protected $table = 'jenis_kegiatan';
    protected $primaryKey = 'id_jenis_kegiatan';
    protected $fillable = [
        'nama_kegiatan'
    ];


    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
