<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan;
use DB;


class KegiatanFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                        ])->paginate(5);
        return view('frontend.kegiatan_front', \compact('kegiatan'));
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
