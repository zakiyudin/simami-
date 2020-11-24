<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = [
        'tanggal_pemasukan',
        'keterangan',
        'nominal_pemasukan',
        'uraian'
    ];
}
