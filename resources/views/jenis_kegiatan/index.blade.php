@extends('layouts.global')

@section('judul')
    Jenis Kegiatan
@endsection

@section('extend_css')
    
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
                    <h2 class="title-1 mb-1">Data Jenis Kegiatan</h2>                
                        {{-- <i class="fas fa-user-plus"></i> --}}
                        <button class="btn btn-primary m-2" data-toggle="modal" data-target="#modal_tambah_edit" id="tambah"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>
                </div>
            </div>
            <br>
        </div>


    


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data" id="data_jenis_kegiatan" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                    {{-- <th width="30px">No</th> --}}
                    <th>No</th>
                    <th width="70%">Nama Kegiatan</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                </table>
            </div>
            </div>
        </div>

        </div>
        <!-- /.container-fluid -->


        
        
    <!-- Modal Tambah -->
    <div class="modal fade" id="modal_tambah_edit" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modal-judul">Tambah Jenis Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="" class="form-group" id="form-tambah-edit">
        @csrf
        <input type="hidden" name="id_jenis_kegiatan" id="id_jenis_kegiatan" class="form-control">
        <label for="">Nama Jenis Kegiatan</label>
        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control">
        <br>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_simpan" value="create">Simpan</button>
    </div>
    </div>
    </div>
    </div>


    {{-- modal konfirmasi hapus user --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">PERHATIAN</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p><b>Jika menghapus Pegawai maka</b></p>
            <p>*data pegawai tersebut hilang selamanya, apakah anda yakin?</p>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" name="btn_hapus" id="btn_hapus">Hapus
                Data</button>
        </div>
    </div>
    </div>
    </div>

@endsection

@section('extend_js')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#data_jenis_kegiatan").DataTable({
                processing  : true,
                serverSide  : true,
                ajax:"{{ route('jenis_kegiatan.index') }}",
                columns : [
                    {data:'id_jenis_kegiatan', name:'id_jenis_kegiatan'},
                    {data:'nama_kegiatan', name:'nama_kegiatan'},
                    {data:'action', name:'action'}
                ]
            })

            $("#tambah").click(function(){
                $("#btn-simpan").val('create-post');
                $("#id_jenis_kegiatan").val('');
                $("#form-tambah-edit").trigger('reset');
                $("#modal-judul").html('Tambah Jenis Kegiatan');
                $("#modal_tambah_edit").modal('show');
            });

            $("#btn_simpan").on('click', function(){
                var nama_kegiatan = $("#nama_kegiatan").val();

                if(nama_kegiatan != ""){
                    $.ajax({
                        url:"{{ route('jenis_kegiatan.store') }}",
                        type: "post",
                        dataType:"json",
                        data:{
                            nama_kegiatan : nama_kegiatan
                        },
                        success : function(data){
                            $("#modal_tambah_edit").modal('hide');

                            swal("Berhasil !!", "Data Berhasil Disimpan", "success");
                        },
                        error : function(data){
                            console.log("Error :", data);
                        }
                    })
                }else{
                    swal("Gagal !!", "Data Harus Diisi Semua", "warning");
                }
            })


            $("body").on('click', '.edit-post', function(){
                var id = $(this).data('id');
                // console.log(id);
                $.ajax({
                    type:'get',
                    url : "jenis_kegiatan/"+id+"/edit",
                    data:{
                        id_jenis_kegiatan : id,
                    },
                    dataType : "json",
                    success: function(data){
                        $("#modal-judul").html('Edit Jenis Penceramah');
                        $("#modal_tambah_edit").modal('show');
                        $("btn_simpan").val('edit-post');

                        $("#nama_kegiatan").val(data.nama_kegiatan);
                    }
                })
            })

            $("body").on('click', '.delete', function(){
                var id = $(this).data('id');
                confirm("Apakah Anda Yakin Ingin Menghapis ??");

                $.ajax({
                    type: "delete",
                    url: "/jenis_kegiatan/"+id,
                    data: {
                        id_jenis_kegiatan : id,
                    },
                    dataType: "json",
                    success: function (response) {
                        swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                    }
                });
            })

        });

        
    </script>
@endsection