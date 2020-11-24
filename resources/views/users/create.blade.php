@extends('layouts.global')

@section('judul')
    Tambah Data User
@endsection

@section('content')
<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">User</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Tambah Data</h3>
            </div>
            <hr>
            <form action="{{ url('/user/store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama_depan" class="control-label mb-1">Nama User</label>
                    <input id="nama_depan" name="nama_depan" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                </div>
                <label class=" form-control-label">Peran</label><br>
                    <div class="form-check-inline form-check">
                        <label for="inline-radio1" class="form-check-label mr-3">
                            <input type="radio" id="inline-radio1" name="inline-radios" value="option1" class="form-check-input">One
                        </label>
                        <label for="inline-radio2" class="form-check-label mr-3">
                            <input type="radio" id="inline-radio2" name="inline-radios" value="option2" class="form-check-input">Two
                        </label>
                        <label for="inline-radio3" class="form-check-label mr-3">
                            <input type="radio" id="inline-radio3" name="inline-radios" value="option3" class="form-check-input">Three
                        </label>
                    </div>
                    <br>
                
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