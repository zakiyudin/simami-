<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
        if($request->ajax()){
            $kegiatan = DB::table('kegiatan')
                            ->join('penceramah', 'penceramah.id_penceramah', '=', 'kegiatan.penceramah_id')
                            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis_kegiatan', '=', 'kegiatan.jenis_kegiatan_id')
                            ->select('kegiatan.judul', 'kegiatan.deskripsi', 'kegiatan.tanggal', 'kegiatan.waktu', 'penceramah.nama_penceramah', 'jenis_kegiatan.nama_kegiatan')
                            ->get();
        }
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
        $hapus_kegiatan = Kegiatan::findOrFail($id);
        $hapus_kegiatan->delete();

        return redirect('/kegiatan')->with('sukses', 'Data Berhasil Dihapus');
    }
}
