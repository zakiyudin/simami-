<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Kegiatan;
use App\Penceramah;
use App\JenisKegiatan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penceramah = Penceramah::all();
        $jenis_kegiatan = JenisKegiatan::all();
                            
        if($request->ajax()){
            $kegiatan = DB::table('kegiatan')
                            ->join('penceramah', 'penceramah.id_penceramah', '=', 'kegiatan.penceramah_id')
                            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis_kegiatan', '=', 'kegiatan.jenis_kegiatan_id')
                            ->select([
                                'kegiatan.id_kegiatan',
                                'kegiatan.judul',
                                'kegiatan.deskripsi',
                                'kegiatan.tanggal',
                                'kegiatan.waktu',
                                'penceramah.nama_penceramah',
                                'jenis_kegiatan.nama_kegiatan'
                            ]);
                            
            return DataTables::of($kegiatan)
            ->addColumn('action', function($kegiatan){
                $btn = '<a href="javascript:void(0)" data-target="#edit_user" data-toggle="tooltip"  data-id="'.$kegiatan->id_kegiatan.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> EDIT</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$kegiatan->id_kegiatan.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> HAPUS</a>';
                $btn .= '&nbsp;&nbsp;';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('kegiatan.index', ['penceramah' => $penceramah, 'jenis_kegiatan' => $jenis_kegiatan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $jenis_kegiatan = Kegiatan::with('get_jenis_kegiatan', 'get_penceramah')->get();
        // return view('kegiatan.create', ['jenis_kegiatan' => $jenis_kegiatan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $kegiatan = Kegiatan::updateOrCreate(
                ['id_kegiatan'          => $request->id_kegiatan],
                [
                    'judul'             => $request->judul,
                    'tanggal'           => $request->tanggal,
                    'deskripsi'         => $request->deskripsi,
                    'waktu'             => $request->waktu,
                    'penceramah_id'     => $request->penceramah_id,
                    'jenis_kegiatan_id' => $request->jenis_kegiatan_id
                ]
           );
        
        return response()->json($kegiatan);
    
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
        $edit = Kegiatan::where('id_kegiatan', $id)->first();
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
        $hapus = Kegiatan::where('id_kegiatan', $id)->delete();

        return response()->json($hapus);
    }
}
