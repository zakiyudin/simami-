<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use Yajra\DataTables\Facades\DataTables;
use DB;


class PengeluaranFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total_pengeluaran = DB::table('pengeluaran')->sum('nominal_pengeluaran');
        $total_pengeluaran = 'Rp. ' . number_format($total_pengeluaran, 0, ",", ".");

        if($request->ajax()){
            $pengeluaran = Pengeluaran::query('select * from pengeluaran');
            return DataTables::eloquent($pengeluaran)
            ->editColumn('nominal_pengeluaran', function(Pengeluaran $nominal_pengeluaran){
                $nominal = 'Rp.'. number_format($nominal_pengeluaran->nominal_pengeluaran, 0, ",", ".");
                return $nominal;
            })
            ->addColumn('action', function($pengeluaran){
                $btn = '<a href="javascript:void(0)" data-target="#edit_users" data-toggle="tooltip"  data-id="'.$pengeluaran->id_pengeluaran.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$pengeluaran->id_pengeluaran.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['action', 'nominal_pengeluaran'])
            ->make(true);
        }
        return view('frontend.pengeluaran_front', ['total_pengeluaran' => $total_pengeluaran]);
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
