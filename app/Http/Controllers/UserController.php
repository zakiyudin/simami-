<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $user = User::query('select * from users');
        return DataTables::eloquent($user)
        ->addColumn('action', function($u){
            $btn = '<a href="javascript:void(0)" data-target="#edit_user" data-toggle="tooltip"  data-id="'.$u->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
            $btn .= '&nbsp;&nbsp;';
            $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$u->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus</a>';
            // $btn = '<a href="javascript:void(0)" class="btn btn-warning"><i class="fas fa-pen"></i></a>';
            // $btn2 = $btn .  '<a href="#" class="btn btn-warning"><i class="fas fa-pen"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
        return view('users.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = User::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'role'  => $request->role,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat_ktp' => $request->alamat_ktp,
                'password' => bcrypt($request->password),
                'status_aktif' => $request->status_aktif
            ]
        );

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
        $where = array('id' => $id);
        $edit_user = User::where($where)->first();

        return response()->json($edit_user);
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
        $delete = User::where('id', $id)->delete();

        return response()->json($delete);
    }
}
