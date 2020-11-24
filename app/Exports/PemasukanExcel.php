<?php

namespace App\Exports;

use App\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemasukanExcel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pemasukan::all();
    }
}
