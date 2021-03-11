@extends('layouts.global')

@section('judul')
    Kegiatan
@endsection

@section('extend_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            {{-- @if (session('status'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1 mb-1">Kegiatan</h2>                
                            {{-- <i class="fas fa-user-plus"></i> --}}
                    </div>
                </div>
                <br>
            </div>
    
           

    
              <!-- DataTales Example -->
              <div class="card shadow mb-4">

                
                <div class="card-body">
                  <a href="javascript:void(0)" class="btn btn-primary m-2" id="tambah_kegiatan">TAMBAH</a>
                  {{-- <button class="btn btn-primary m-2" data-toggle="modal" data-target="#modal_tambah_kegiatan" id="tambah_kegaitan"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button> --}}
                  <div class="table-responsive">
                    <table class="table table-bordered data" id="data_kegiatan" width="100%" cellspacing="0">
                      <thead class="thead-dark">
                        <tr>
                          {{-- <th width="30px">No</th> --}}
                          <th>No</th>
                          <th>Judul</th>
                          <th>Jenis Kegiatan</th>
                          <th>Penceramah</th>
                          <th>Deskripsi</th>
                          <th>Tgl Kegiatan</th>
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
    <div class="modal fade" id="modal_tambah_kegiatan" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-judul">Tambah Kegiatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="form-group" method="POST" id="form-tambah-kegiatan">
              @csrf
              <input type="hidden" name="id_kegiatan" id="id_kegiatan" class="form-control">
              <label for="">Tanggal Kegiatan</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control" required>
              <br>
    
              <label for="">Judul Kegiatan</label>
              <input type="text" name="judul" id="judul" class="form-control" required>
              <br>

              <label for="">Deskripsi Kegiatan</label>
              <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" required></textarea>
              <br>

              <label for="waktu">Jam</label>
              <div class="input-group bootstrap-timepicker timepicker">
                <input id="waktu" name="waktu" class="form-control" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text" required/>
              </div>
              <br>
    
              <label for="">Penceramah</label>
              <select name="penceramah_id" id="nama_penceramah" class="form-control" required>
                <option value="">.:: Pilih Satu ::.</option>
                @foreach ($penceramah as $penceramah)    
                  <option value="{{ $penceramah->id_penceramah }}" >{{  $penceramah->nama_penceramah  }}</option>
                @endforeach
              </select>
              <br>

              <label for="">Jenis Kegiatan</label>
              <select name="jenis_kegiatan_id" id="nama_kegiatan" class="form-control" required>
                <option value="">.:: Pilih Satu ::.</option>
                @foreach ($jenis_kegiatan as $jenisKeg)    
                  <option value="{{ $jenisKeg->id_jenis_kegiatan }}" > {{ $jenisKeg->nama_kegiatan }}</option>
                @endforeach
              </select>
              <br>
              <input type="submit" id="simpan_kegiatan" value="Simpan" class="btn btn-primary">
    
            </form>
          </div>
          {{-- <div class="modal-footer">
          </div> --}}
        </div>
      </div>
    </div>
    
    
    {{-- modal konfirmasi hapus user --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal-hapus" data-backdrop="false">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">PERHATIAN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p><b>APAKAH ANDA YAKIN INGIN MENGHAPUS ??</b></p>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#data_kegiatan").DataTable({
                processing : true,
                serverSide : true,
                ajax       : "{{ route('kegiatan.index') }}",
                columns    :[
                    {data : 'id_kegiatan', name : 'id_kegiatan'},
                    {data : 'judul', name : 'judul'},
                    {data : 'nama_kegiatan', name : 'jenis_kegiatan.nama_kegiatan'},
                    {data : 'nama_penceramah', name : 'penceramah.nama_penceramah'},
                    {data : 'deskripsi', name : 'deskripsi'},
                    {data : 'tanggal', name : 'tanggal'},
                    {data : 'action', name : 'action'}
                ]
            })

            $("#tambah_kegiatan").click(function(event) {
              event.preventDefault();
              $("#modal_tambah_kegiatan").modal('show');
            });

            
            if($("#form-tambah-kegiatan").length > 0){
              $("#form-tambah-kegiatan").validate({
                submitHandler : function(form){
                  var actionType = $("#simpan_kegaitan").val();
                  $("#simpan_kegiatan").html("sending...");
                  
                  $.ajax({
                    type: "POST",
                    url: "{{ route('kegiatan.store') }}",
                    data: $("#form-tambah-kegiatan").serialize(),
                    dataType: "json",
                    success: function (data) {
                      $("#form-tambah-kegiatan").trigger("reset");
                      $("#modal_tambah_kegiatan").modal("hide");
                      $("#simpan_kegaitan").html("Simpan");

                      var table = $("#data_kegiatan").dataTable();
                      table.fnDraw(false);
                      swal("Good job!", "Data Berhasil Disimpan", "success");
                    },
                    error : function(data){
                      console.log('Error,', data);
                    }
                  });
                }
              });
            }



            $("body").on("click", ".edit-post", function(){
              var data_id = $(this).data('id');
              // console.log(data_id);

              $.ajax({
                type: "GET",
                url: "kegiatan/" + data_id + "/edit",
                data: {
                  id_kegaitan : data_id
                },
                dataType: "json",
                success: function (data) {
                  $("#modal-judul").html("Edit Kegiatan");
                  $("#simpan_kegiatan").val("edit-post");
                  $("#modal_tambah_kegiatan").modal("show");

                  $("#id_kegiatan").val(data.id_kegiatan);
                  $("#tanggal").val(data.tanggal);
                  $("#judul").val(data.judul);
                  $("#deskripsi").val(data.deskripsi);
                  $("#waktu").val(data.waktu);
                  $("#nama_penceramah").val(data.penceramah_id);
                  $("#nama_kegiatan").val(data.jenis_kegiatan_id);
                },
                error : function(data){
                  console.log("Error : ", data);
                }
              });
              
            })



            $("body").on("click", ".delete", function(){
              data_id = $(this).data("id");
              // console.log(data_id);
              $("#konfirmasi-modal-hapus").modal("show");

            });

            $("#btn_hapus").click(function(){
              $.ajax({
                type: "DELETE",
                url: "kegiatan/" +data_id,
                dataType: "json",
                success: function (data) {
                  setTimeout(function(){
                    $("#konfirmasi-modal-hapus").modal("hide");
                    var table = $("#data_kegiatan").dataTable();
                    table.fnDraw(false);
                  }, 3000);
                  swal("Good job!", "Data Berhasil Disimpan", "success");
                },
                error : function(data){
                  console.log("Error :", data);
                }
              });
            })
            // var time = $('#timepicker').timepicker('showWidget');
        })
    </script>
@endsection