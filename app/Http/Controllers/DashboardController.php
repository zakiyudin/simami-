<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Pengeluaran;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $waktu_sekarang = Carbon::now()->toFormattedDateString();
        $jum_user = User::all()->count();
        $total_pemasukan = DB::table('pemasukan')->sum('nominal_pemasukan');
        $total_pemasukan = 'Rp. ' . number_format($total_pemasukan, 0, ",", ".");

        $total_pengeluaran = DB::table('pengeluaran')->sum('nominal_pengeluaran');
        $total_pengeluaran = 'Rp. ' . number_format($total_pengeluaran, 0, ",", ".");

        $total_saldo = DB::table('pemasukan')->sum('nominal_pemasukan') - DB::table('pengeluaran')->sum('nominal_pengeluaran');
        $total_saldo = 'Rp. ' . number_format($total_saldo, 0, ",", ".");
        // dd($total_pemasukan, $total_pengeluaran ,$total_saldo);
        return view('dashboard.index',[
            'jum_user' => $jum_user,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'waktu_sekarang' => $waktu_sekarang,
            'total_saldo' => $total_saldo
        ]);
    }


    
}
