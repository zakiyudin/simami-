<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    protected $table = 'visi_masjid';
    protected $primaryKey = 'id_visi';
    protected $fillable = [
        'id_visi',
        'isi_visi'
    ];
}
