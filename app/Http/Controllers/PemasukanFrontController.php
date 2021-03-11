<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use Yajra\DataTables\Facades\DataTables;
use DB;

class PemasukanFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total_pemasukan = DB::table('pemasukan')->sum('nominal_pemasukan');
        $total_pemasukan = 'Rp. ' . number_format($total_pemasukan, 0, ",", ".");

        if($request->ajax()){
            $pemasukan = Pemasukan::query('select * from pemasukan');
            return DataTables::of($pemasukan)
            ->editColumn('nominal_pemasukan', function(Pemasukan $nominal_pemasukan){
                $nomina = "Rp. " . number_format($nominal_pemasukan->nominal_pemasukan, 0, ",", ".");
                return $nomina;
            })
            ->addColumn('action', function($p){
                $btn = '<a href="javascript:void(0)" data-target="#edit_users" data-toggle="tooltip"  data-id="'.$p->id_pemasukan.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$p->id_pemasukan.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['action', 'nominal_pemasukan'])
            ->make(true);
        }
        return view('frontend.pemasukan_front', compact('total_pemasukan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
