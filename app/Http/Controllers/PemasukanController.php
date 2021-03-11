<?php

namespace App\Http\Controllers;

use App\Exports\PemasukanExcel;
use App\Pemasukan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;
use Illuminate\Support\Facades\Validator;

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
        $total_pemasukan = DB::table('pemasukan')->sum('nominal_pemasukan');
        $total_pemasukan = 'Rp. ' . number_format($total_pemasukan, 0, ",", ".");
        return view('pemasukan.index', ['total_pemasukan' => $total_pemasukan]);
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
        $pemasukan = Pemasukan::updateOrCreate(
                ['id_pemasukan' => $request->id_pemasukan],
                [
                    'tanggal_pemasukan' => $request->tanggal_pemasukan,
                    'uraian'            => $request->uraian,
                    'nominal_pemasukan' => $request->nominal_pemasukan,
                    'keterangan'           => $request->keterangan
                ]
            );
        
        return response()->json($pemasukan);
    }
        // $validator = Validator::make($request->all(),[
        //     'tanggal_pemasukan' => 'required',
        //     'uraian' => 'required',
        //     'nominal_pemasukan' => 'required|numeric',
        // ]);

        // if($validator->fails()){
        //     return response()->json(['errors' => $validator->getMessageBag->toArray()]);
        // }else{
        //     $tambah_pemasukan = new Pemasukan();
        //     $tambah_pemasukan->tanggal_pemasukan = $request->tanggal_pemasukan;
        //     $tambah_pemasukan->uraian = $request->uraian;
        //     $tambah_pemasukan->nominal_pemasukan = $request->nominal_pemasukan;
        //     $tambah_pemasukan->keterangan = $request->keterangan;

        //     $tambah_pemasukan->save();

        //     return response()->json(['success' => 'data ditambahkan']);
        // $id = $request->id_pemasukan;
        // $tanggal_pemasukan = $request->tanggal_pemasukan;
        // $uraian = $request->uraian;
        // $nominal = $request->nominal_pemasukan;
        // $keterangan = $request->keterangan;
        // $post = Pemasukan::updateOrCreate(
        //     [
        //         'id_pemasukan' => $id,
        //     ],
        //     [
        //         'tanggal_pemasukan'     => $tanggal_pemasukan,
        //         'uraian'                => $uraian,
        //         'nominal_pemasukan'     => $nominal,
        //         'keterangan'            => $keterangan,
        //     ]);
        // return response()->json($post);
    

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
    public function update(Request $request)
    {
       $data = [
           'tanggal_pemasukan' => $request->tanggal_pemasukan,
           'uraian'            => $request->uraian,
           'nominal_pemasukan' => $request->nominal_pemasukan,
           'keterangan'       => $request->keterangan
       ];

       Pemasukan::where('id_pemasukan', $request->id_pemasukan)->update($data);
       return response()->json(['sukses' => 'data berhasil diupdate']);
    //    Pemasukan::whereId($request->id_pemasukan)->update($data);
       
        // $update_pemasukan = Pemasukan::find($id);
        // $update_pemasukan->update([
        //     'tanggal_pemasukan' => $request->tanggal_pemasukan,
        //     'uraian'            => $request->uraian,
        //     'nominal_pemasukan' => $request->nominal_pemasukan,
        //     'keterangan'        => $request->keterangan
        // ]);

        // $update_pemasukan->tanggal_pemasukan = $request->tanggal_pemasukan;
        // $update_pemasukan->uraian            = $request->uraian;
        // $update_pemasukan->nominal_pemasukan = $request->nominal_pemasukan;
        // $update_pemasukan->keterangan        = $request->keterangan;
        // $update_pemasukan->save();
        

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

    public function print_pdf($tgl_awal, $tgl_akhir)
    {
        // dd("tanggal_awal : ".$tgl_awal, "tanggal_akhir : ".$tgl_akhir);
        $pemasukan = DB::table('pemasukan')->whereBetween('tanggal_pemasukan', [$tgl_awal, $tgl_akhir])->get();
        $total_pemasukan = DB::table('pemasukan')->whereBetween('tanggal_pemasukan', [$tgl_awal, $tgl_akhir])->sum('nominal_pemasukan');

        $pdf = PDF::loadview('pemasukan.pemasukan_pdf',[
                'pemasukan' => $pemasukan,
                'total_pemasukan' => $total_pemasukan
            ]);
        return $pdf->stream();
    }

}
