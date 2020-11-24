<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Pengeluaran;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jum_user = User::all()->count();
        return view('dashboard.index',['jum_user' => $jum_user]);
    }


    
}
