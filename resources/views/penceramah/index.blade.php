@extends('layouts.global')

@section('judul')
    Penceramah
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container">
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
                        <h2 class="title-1 mb-1">Data Penceramah</h2>                
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
                    <table class="table table-bordered data" id="data_penceramah" width="100%" cellspacing="0">
                      <thead class="thead-dark">
                        <tr>
                          {{-- <th width="30px">No</th> --}}
                          <th>No</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>No HP</th>
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
            <h5 class="modal-title" id="modal-judul">Tambah Penceramah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="form-group" id="form-tambah-edit">
              @csrf
              <input type="hidden" name="id_penceramah" id="id_penceramah" class="form-control">
              <label for="">Nama Penceramah</label>
              <input type="text" name="nama_penceramah" id="nama_penceramah" class="form-control">
              <br>
    
              <label for="">No Hp Penceramah</label>
              <input type="text" name="no_hp_penceramah" id="no_hp_penceramah" class="form-control">
              <br>
    
              <label for="">Alamat Penceramah</label>
              <textarea name="alamat_penceramah" id="alamat_penceramah" cols="30" rows="7" class="form-control"></textarea>
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
                  <p><b>Jika menghapus Peneramah maka</b></p>
                  <p>*data Penceramah tersebut hilang selamanya, apakah anda yakin?</p>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-danger" name="btn_hapus" id="btn_hapus">Hapus
                      Data</button>
              </div>
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

            $("#data_penceramah").DataTable({
                processing : true,
                serverSide : true,
                ajax : "{{ route('penceramah.index') }}",
                columns:[
                    {data:'id_penceramah', name:'id_penceramah'},
                    {data:'nama_penceramah', name:'nama_penceramah'},
                    {data:'alamat_penceramah', name:'alamat_penceramah'},
                    {data:'no_hp_penceramah', name:'no_hp_penceramah'},
                    {data:'action', name:'action'}
                ]
            });
            
            $("#tambah").click(function (e) { 
                e.preventDefault();
                $("#btn_simpan").val('create-post');
                $("#id_penceramah").val();
                $("#form-tambah-edit").trigger('reset');
                $("#modal-judul").html('Tambah Penceramah');
                $("#modal_tambah_edit").modal('show');
            });

            $("#btn_simpan").click(function (e) { 
                e.preventDefault();
                var nama_penceramah = $("#nama_penceramah").val();
                var alamat_penceramah = $("#alamat_penceramah").val();
                var no_hp_penceramah = $("#no_hp_penceramah").val();

                if(nama_penceramah != "" && alamat_penceramah != "" && no_hp_penceramah != ""){
                    $.ajax({
                        url:"{{ route('penceramah.store') }}",
                        type: "post",
                        dataType: "json",
                        data : {
                            nama_penceramah : nama_penceramah,
                            alamat_penceramah : alamat_penceramah,
                            no_hp_penceramah : no_hp_penceramah
                        },
                        success : function(data){
                            $("#mdoal_tambah_edit").modal('hide');

                            swal("Good Job!", "Data Berhasi Disimpan", "success");
                        },
                        error : function(data){
                            console.log("Error", data);
                        }
                    });
                }else{
                    swal("Error!!", "Data Harus Diisi", "warning");
                }
                
            });


            $("body").on('click', '.edit-post', function(){
                var id = $(this).attr("data-id");
                // console.log(id);
                $.ajax({
                    type: "get",
                    url: "penceramah/"+id+"/edit",
                    data: {
                        id_penceramah:id
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#modal-judul").html('Edit Penceramah');
                        $("#modal_tambah_edit").modal('show');
                        $("#btn_simpan").val('edit-post');

                        $("#nama_penceramah").val(response.nama_penceramah);
                        $("#no_hp_penceramah").val(response.no_hp_penceramah);
                        $("#alamat_penceramah").val(response.alamat_penceramah);
                    }
                });
            });

            $("body").on('click', '.delete', function(){
                var id = $(this).data('id');
                var konfirmasi = confirm('apakah anda yakin menghapus data ini ?');
                // console.log(id);
                $.ajax({
                    type: "delete",
                    url: "/penceramah/"+id,
                    data: {
                        id_penceramah:id
                    },
                    dataType: "json",
                    success: function (response) {
                        swal("Berhasil", "Data Berhasil Dihapus", "success");
                    },
                    error:function(data){
                        console.log("Error",data);
                    }
                });
            });



        });
    </script>
@endsection