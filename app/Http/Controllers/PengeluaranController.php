<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        return view('pengeluaran.index');
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
        $id = $request->id_pengeluaran;
        $post = Pengeluaran::updateOrCreate(['id_pengeluaran' => $id],
        [
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'uraian' => $request->uraian,
            'nominal_pengeluaran' => $request->nominal_pengeluaran,
            'keterangan' => $request->keterangan
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
        $where = array('id_pengeluaran' => $id);
        $edit = Pengeluaran::where($where)->first();

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
        $rules = [
            'tanggal_pengeluaran' => 'required',
            'keterangan'          => 'required',
            'uraian'              => 'required',
            'nominal_pengeluaran' => 'required',
        ];

        $validasi = Validator::make($request->all(), $rules);
        if($validasi->fails()){
            return response()->json(['error' => $validasi->errors()->all()]);
        }

        $form_data = [
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan'          => $request->keterangan,
            'uraian'              => $request->uraian,
            'nominal_pengeluaran' => $request->nominal_pengeluaran
        ];

        $pengeluaran = Pengeluaran::whereId($request->id_pengeluaran)->update($form_data);

        return response()->json($pengeluaran);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pengeluaran::where('id_pengeluaran', $id);
        $delete->delete();

        return response()->json($delete);
    }
}
