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

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1 mb-1">DATA JENIS KEGIATAN</h2>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <button class="btn btn-primary m-2" id="tambah"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                </div>

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
        </div>

        


    


        <!-- DataTales Example -->
        
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
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" id="btn_simpan" value="create">Simpan</button>
        </form>
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

           var datatable = $("#data_jenis_kegiatan").DataTable({
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
                $("#modal-judul").html("Tambah Jenis Kegiatan Baru");
               $("#modal_tambah_edit").modal("show");
            });

            if($("#form-tambah-edit").length > 0){
                $("#form-tambah-edit").validate({
                    submitHandler : function(form){
                        var actionType = $("#btn_simpan").val();
                        $("#btn_simpan").html("Sending...");

                        $.ajax({
                            type: "POST",
                            url: "{{ route('jenis_kegiatan.store') }}",
                            data: $("#form-tambah-edit").serialize(),
                            dataType: "json",
                            success: function (data) {
                                $("#form-tambah-edit").trigger("reset");
                                $("#modal_tambah_edit").modal("hide");
                                var table = $("#data_jenis_kegiatan").dataTable();
                                table.fnDraw(false);

                                swal("Good job!", "Data Berhasil Disimpan", "success");
                            },
                            error : function(data){
                                console.log("Error :", data);
                            }
                        });
                    }
                })
            }


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
                        $("#btn_simpan").val('update');
                        $("#btn_simpan").html("Update");
                        $("#modal_tambah_edit").modal('show');

                        $("#id_jenis_kegiatan").val(data.id_jenis_kegiatan);
                        $("#nama_kegiatan").val(data.nama_kegiatan);
                    },
                    error : function(data){
                        console.log("Error :", data);
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
                        var table = $("#data_jenis_kegiatan").dataTable();
                        table.fnDraw(false);
                        swal("Berhasil !!", "Data Berhasil Dihapus", "success");
                    }
                });
            })

        });

        
    </script>
@endsection