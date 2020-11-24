<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
        'tanggal_pengeluaran',
        'keterangan',
        'nominal_pengeluaran',
        'uraian'
    ];
}
