<?php

namespace App\Http\Controllers;

use App\Exports\PemasukanExcel;
use App\Pemasukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $pemasukan = Pemasukan::query('select * from pemasukan');
            return DataTables::eloquent($pemasukan)
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
        return view('pemasukan.index');
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
        $id = $request->id_pemasukan;
        $tanggal_pemasukan = $request->tanggal_pemasukan;
        $uraian = $request->uraian;
        $nominal = $request->nominal_pemasukan;
        $keterangan = $request->keterangan;
        $post = Pemasukan::updateOrCreate(
            [
                'id_pemasukan' => $id,
            ],
            [
                'tanggal_pemasukan'     => $tanggal_pemasukan,
                'uraian'                => $uraian,
                'nominal_pemasukan'     => $nominal,
                'keterangan'            => $keterangan,
            ]);
        return response()->json($post);
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
        $where = array('id_pemasukan' => $id);

        $edit = Pemasukan::where($where)->first();

        return response()->json($edit);
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
        $delete = Pemasukan::where('id_pemasukan', $id)->delete();

        return response()->json($delete);
    }

    public function export(){
        // return Excel::download(new PemasukanExcel, 'pemasukan.xlxs');
        return Excel::download(new PemasukanExcel(), 'pemasukan.xlxs');
    }

    public function print_pdf()
    {
        $pdf = PDF::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>TEST</h1>');
        return $pdf->downlaod();
    }
    // $pemasukan = Pemasukan::all();
    
    // $pdf = PDF::loadview('pemasukan.pemasukan_pdf',['pemasukan' => $pemasukan]);
    // return $pdf->download('laporan_pemasukan_pdf');
}
