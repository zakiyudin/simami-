@extends('layouts.global')

@section('judul')
    Tambah Kegiatan
@endsection

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">Kegiatan</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Tambah Data</h3>
            </div>
            <hr>
            <form action="{{ url('/kegiatan/store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="judul" class="control-label mb-1">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="control-label mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group has-success">
                    <label for="nama_belakang" class="control-label mb-1">Tanggal</label>
                    <input id="nama_belakang" name="nama_belakang" type="text" class="form-control" aria-required="true" aria-invalid="false">                    
                </div>
                <div class="form-group">
                    <label for="usia" class="control-label mb-1">Jam</label>
                    <input id="usia" name="usia" type="number" class="form-control">                    
                </div>
                <div class="form-group">
                    <label for="jenis_kegiatan" class="control-label-mb-1">Jenis Kegiatan</label>
                    <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control">
                       <option value="" disabled selected>.:: Pilih Jenis Kegiatan ::.</option>
                       @foreach ($jenis_kegiatan as $kegiatan)
                           <option value="{{ $kegiatan->get_jenis_kegiatan }}">{{ $kegiatan->get_jenis_kegiatan->nama_kegiatan }}</option>
                       @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_penceramaha" class="control-label-mb-1">Penceramah</label>
                    <select name="nama_penceramaha" id="nama_penceramaha" class="form-control">
                       <option value="" disabled selected>.:: Pilih Penceramah ::.</option>
                       @foreach ($jenis_kegiatan as $kegiatan)
                           <option value="{{ $kegiatan->get_penceramah->id }}">{{ $kegiatan->get_penceramah->nama_penceramah }}</option>
                       @endforeach
                    </select>
                </div>
                
                <div class="form-group">                   
                    <label for="avatar" class="control-label mb-1">Nama Penceramah</label>
                    <input type="text" id="avatar" name="avatar" class="form-control mb-1">                    
            </div>
                                
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