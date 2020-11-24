<?php

namespace App\Http\Controllers;

use App\Muadzin;
use Illuminate\Http\Request;

class MuadzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_muadzin = Muadzin::all();
        return view('muadzin.index', ['data_muadzin' => $data_muadzin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('muadzin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Muadzin::create($request->all());
        return redirect('/muadzin')->with('sukses', 'Data Berhasil Ditambah');
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
        $edit_muadzin = Muadzin::findOrFail($id);
        return view('muadzin.edit', ['edit_muadzin' => $edit_muadzin]);
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
        //dd($request->all());
        $update_muadzin = Muadzin::findOrFail($id);
        $update_muadzin->update($request->all());

        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $update_muadzin->avatar = $request->file('avatar')->getClientOriginalName();
            $update_muadzin->save();
        }

        return redirect('/muadzin')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus_muadzin = Muadzin::findOrFail($id);
        $hapus_muadzin->delete();

        return redirect('/muadzin')->with('sukkses', 'Data Berhasil Dihapus');
    }
}
