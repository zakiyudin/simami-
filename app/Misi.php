<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    protected $table = "misi_masjid";
    protected $primaryKey = "id_misi";
    protected $fillable = [
        "isi_misi"
    ];
}
