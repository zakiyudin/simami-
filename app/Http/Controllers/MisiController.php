<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Misi;


class MisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $misi = Misi::query("select * from misi_masjid");
            return DataTables::eloquent($misi)
            ->addColumn('action', function($misi){
                $btn = '<a href="javascript:void(0)" data-target="#edit_users" data-toggle="tooltip"  data-id="'.$misi->id_misi.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$misi->id_misi.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view("misi.index");
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
        $misi = Misi::updateOrCreate(
            ['id_misi' => $request->id_misi],
            ['isi_misi' => $request->isi_misi]
        );

        return response()->json($misi);
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
        $edit = Misi::where(['id_misi' => $id])->first();

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
        $delete = Misi::where('id_misi', $id)->delete();

        return response()->json($delete);
    }
}
