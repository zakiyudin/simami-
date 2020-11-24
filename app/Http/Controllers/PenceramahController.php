<?php

namespace App\Http\Controllers;

use App\Penceramah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class PenceramahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $peneramah = Penceramah::query('select * from penceramah');
            return DataTables::eloquent($peneramah)
            ->addColumn('action', function($p)
            {
                $btn = '<a href="javascript:void(0)" data-target="#edit_user" data-toggle="tooltip"  data-id="'.$p->id_penceramah.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$p->id_penceramah.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('penceramah.index');
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
        $penceramah = Penceramah::where('id_penceramah', $request->id_penceramah)->first();

        if($penceramah != ""){
            $penceramah->update();
        }else{
            $penceramah = Penceramah::create([
                'nama_penceramah' => $request->nama_penceramah,
                'alamat_penceramah' => $request->alamat_penceramah,
                'no_hp_penceramah' => $request->no_hp_penceramah
            ]);
        }

        return response()->json($penceramah);
        // $id = $request->id_penceramah;
        // $post = Penceramah::updateOrCreate(['id_penceramah' => $id],
        // [
        //     'nama_penceramah' => $request->nama_penceramah,
        //     'alamat_penceramah' => $request->alamat_penceramah,
        //     'no_hp_penceramah' => $request->no_hp_penceramah
        // ]);

        // return response()->json($post);
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
        $where = ['id_penceramah' => $id];
        $edit = Penceramah::where($where)->first();

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
        $delete = Penceramah::where('id_penceramah', $id)->delete();

        return response()->json($delete);
    }
}
