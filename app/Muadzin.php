<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muadzin extends Model
{
    protected $table = 'muadzin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'alamat',
        'usia',
        'avatar'
    ];
}
