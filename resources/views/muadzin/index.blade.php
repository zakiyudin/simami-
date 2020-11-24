{{-- {{ dd($data_muadzin) }} --}}

@extends('layouts.global')

@section('judul')
    Data Muadzin
@endsection

@section('content')
<div class="container-fluid">
    @if (session('sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{ session('sukses') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1 mb-1">Data Muadzin</h2>
                <a href="/muadzin/create" class="au-btn au-btn-icon au-btn--green mb-1">
                    <i class="fas fa-user-plus"></i>                    
                </a>
            </div>
        </div>
        <br>
    </div>
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_muadzin as $muadzin)
                        <tr>
                            <td>{{ $muadzin->id }}</td>
                            <td>{{ $muadzin->nama_depan }}</td>
                            <td>{{ $muadzin->nama_belakang }}</td>
                            <td>{{ $muadzin->usia }}</td>                            
                            <td>{{ $muadzin->alamat }}</td>
                            <td>
                                <a href="{{ url('/muadzin/'.$muadzin->id.'/edit') }}" class="btn btn-warning m-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ url('/muadzin/'.$muadzin->id.'/destroy') }}" class="btn btn-danger" onclick="return confirm('Anda Yakin Data ini Dihapus ?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>



@endsection