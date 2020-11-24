<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penceramah extends Model
{
    protected $table = 'penceramah';
    protected $primaryKey = 'id_penceramah';
    protected $fillable = [
        'nama_penceramah',
        'alamat_penceramah',
        'no_hp_penceramah'
    ];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
