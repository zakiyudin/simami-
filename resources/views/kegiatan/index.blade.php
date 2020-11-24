{{-- {{ dd($data_muadzin) }} --}}

@extends('layouts.global')

@section('judul')
    Kegiatan
@endsection

@section('content')
<div class="container-fluid">
    <div class="col-sm-12 col-lg-12">
        
    </div>
    @if (session('sukses'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{ session('sukses') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="overview-wrap">
                <h2 class="title-1 mb-1">KEGIATAN</h2>               
                <a href="{{ url('/kegiatan/create') }}" class="au-btn au-btn-icon au-btn--green mb-1">
                    <i class="fas fa-calendar-alt"></i> &nbsp; tambah                    
                </a>
            </div>
        </div>
        <br>
    </div>
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="row">
            @foreach ($kegiatan as $keg)                
            <div class="col-md-6 ">
                <div class="card border border-primary">
                    <div class="card-header">
                        <strong class="card-title">{{ $keg->get_jenis_kegiatan->nama_kegiatan }}</strong>
                    </div>
                    <div class="card-body">
                        <h2>{{ $keg->judul }}</h2>
                        <hr>
                        <h4>{{ $keg->tanggal }}</h4>                        
                    </div>
                    <hr>
                    <div class="card-body">
                        <p class="card-text">{{ $keg->deskripsi }}</p>
                    </div>
                    <hr>
                    <div class="card-body">
                        <a href="#" class="card-link btn btn-warning">Edit</a>
                        <a href="{{ url('/kegiatan/'.$keg->id.'/destroy') }}" class="card-link btn btn-danger">Hapus</a>
                        <a href="#" class="card-link btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>           
            @endforeach
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>



@endsection