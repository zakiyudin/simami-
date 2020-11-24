@extends('layouts.global')

@section('judul')
    Update Data Muadzin
@endsection

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">Muadzin</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Edit Data</h3>
            </div>
            <hr>
            <form action="{{ url('/muadzin/'.$edit_muadzin->id.'/update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama_depan" class="control-label mb-1">Nama Depan</label>
                    <input id="nama_depan" name="nama_depan" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $edit_muadzin->nama_depan }}">
                </div>
                <div class="form-group has-success">
                    <label for="nama_belakang" class="control-label mb-1">Nama Belakang</label>
                    <input id="nama_belakang" name="nama_belakang" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $edit_muadzin->nama_belakang }}">                    
                </div>
                <div class="form-group">
                    <label for="usia" class="control-label mb-1">Usia</label>
                    <input id="usia" name="usia" type="number" class="form-control" placeholder="Berapa Tahun..." value="{{ $edit_muadzin->usia }}">                    
                </div>
                <div class="form-group">                   
                    <label for="avatar" class="control-label mb-1">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-control-file mb-1" value="{{ $edit_muadzin->avatar }}">                    
                </div>
                <textarea  id="textarea-input" name="alamat" rows="9" placeholder="Content..." class="form-control mb-5">{{ $edit_muadzin->alamat }}</textarea>                
                <div>
                    <button type="submit" class="btn btn-lg btn-warning btn-block">
                        <i class="fa fa-check fa-lg"></i>&nbsp;                        
                        <span>UPDATE</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection