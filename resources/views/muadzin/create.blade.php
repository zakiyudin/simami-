@extends('layouts.global')

@section('judul')
    Tambah Data Muadzin
@endsection

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">Muadzin</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Tambah Data</h3>
            </div>
            <hr>
            <form action="{{ url('/muadzin/store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama_depan" class="control-label mb-1">Nama Depan</label>
                    <input id="nama_depan" name="nama_depan" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                </div>
                <div class="form-group has-success">
                    <label for="nama_belakang" class="control-label mb-1">Nama Belakang</label>
                    <input id="nama_belakang" name="nama_belakang" type="text" class="form-control" aria-required="true" aria-invalid="false">                    
                </div>
                <div class="form-group">
                    <label for="usia" class="control-label mb-1">Usia</label>
                    <input id="usia" name="usia" type="number" class="form-control" placeholder="Berapa Tahun...">                    
                </div>
                <div class="form-group">                   
                        <label for="avatar" class="control-label mb-1">Avatar</label>
                        <input type="file" id="avatar" name="avatar" class="form-control-file mb-1">                    
                </div>
                <textarea  id="textarea-input" name="alamat" rows="9" placeholder="Content..." class="form-control mb-5"></textarea>                
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        <i class="fa fa-check fa-lg"></i>&nbsp;                        
                        <span>Tambah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection