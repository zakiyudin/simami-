<?php

namespace App\Http\Controllers;

use App\JenisKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $jenis_kegiatan = JenisKegiatan::query('select * from jenis_kegiatan');
            return DataTables::eloquent($jenis_kegiatan)
            ->addIndexColumn()
            ->addColumn('action', function($jk){
                $btn = '<a href="javascript:void(0)" data-target="#edit_user" data-toggle="tooltip"  data-id="'.$jk->id_jenis_kegiatan.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$jk->id_jenis_kegiatan.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';

                return $btn;
            })
            ->setRowClass(function($jk){
                return $jk->id_jenis_kegiatan % 2 == 0 ? 'alert-success' : 'alert-warning';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('jenis_kegiatan.index');
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
        $id = $request->id_jenis_kegiatan;
        $post = JenisKegiatan::updateOrCreate(['id_jenis_kegiatan' => $id],
        [
            'nama_kegiatan' => $request->nama_kegiatan
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
        $where = ['id_jenis_kegiatan' => $id];
        $edit_jenis_kegiatan = JenisKegiatan::where($where)->first();

        return response()->json($edit_jenis_kegiatan);
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
        $delete = JenisKegiatan::where('id_jenis_kegiatan', $id)->delete();

        return response()->json($delete);
    }
}
