<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = "tentang";
    protected $primaryKey = "id_tentang";
    protected $fillable = [
        'isi_tentang'
    ];
}
