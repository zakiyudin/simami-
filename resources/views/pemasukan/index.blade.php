@extends('layouts.global')

@section('judul')
    Pemasukan
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container-fluid">
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
                        <h2 class="title-1 mb-1">Data Pemasukan</h2>                
                            {{-- <i class="fas fa-user-plus"></i> --}}
                            <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal_tambah_edit" id="tambah_pemasukan"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>

                            <a href="{{ route('excel') }}" class="btn btn-success mb-1" id="export_excel"><i class="fas fa-file-export"></i>&nbsp;Excel</a>

                            <a href="{{ route('pdf') }}" class="btn btn-danger mb-1"><i class="fas fa-download"></i>&nbsp;PDF</a>
                    </div>
                </div>
                <br>
            </div>
    
    
           
    
    
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered data" id="data_pemasukan" width="100%" cellspacing="0">
                      <thead class="thead-dark">
                        <tr>
                          {{-- <th width="30px">No</th> --}}
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Uraian</th>
                          <th>Nominal</th>
                          <th>Ket.</th>
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
          <h5 class="modal-title" id="modal-judul">Tambah Pemasukan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" class="form-group" id="form-tambah-edit">
            @csrf
            <input type="hidden" name="id_pemasukan" id="id_pemasukan" class="form-control">
            <label for="">Tanggal</label>
            <input type="date" name="tanggal_pemasukan" id="tanggal_pemasukan" class="form-control">
            <br>
  
            <label for="">Uraian</label>
            <textarea name="uraian" id="uraian" cols="30" rows="3" class="form-control"></textarea>
            <br>
  
            <label for="">Nominal Pemasukan</label>
            <input type="number" name="nominal_pemasukan" id="nominal_pemasukan" class="form-control">
            <br>
  
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control">
            <br>
  
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btn_simpan" value="create">Simpan</button>
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

            $("#data_pemasukan").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('pemasukan.index') }}",
            columns:[
                {data:'id_pemasukan', name:'id_pemasukan'},
                {data:'tanggal_pemasukan', name:'tanggal_pemasukan'},
                {data:'uraian', name:'uraian'},
                {data:'nominal_pemasukan', name:'nominal_pemasukan'},
                {data:'keterangan', name:'keterangan'},
                {data:'action', name:'action'},
            ]
        });

        $("#tambah_pemasukan").click(function(){
          $("#btn_simpan").val('create-post');
          $("#id").val('');
          $("#form-tambah-edit").trigger('reset');
          $("#modal-judul").html('Tambah Pemasukan');
          $("#modal_tambah_edit").modal("show");

            //SIMMPAN DAN EDIT DATA USER
    $("#btn_simpan").on('click', function(){
      var tanggal_pemasukan = $("#tanggal_pemasukan").val();
      var uraian = $("#uraian").val();
      var nominal_pemasukan = $("#nominal_pemasukan").val();
      var keterangan = $("#keterangan").val();
      
      if(tanggal_pemasukan != "" && uraian != "" && nominal_pemasukan != "" && keterangan != ""){
        $("#btn_simpan").attr('disabled', 'disabled');
        $.ajax({
          url:"{{ route('pemasukan.store') }}",
          type: "post",
          dataType:'json',
          data:{
            tanggal_pemasukan : tanggal_pemasukan,
            uraian : uraian,
            nominal_pemasukan : nominal_pemasukan,
            keterangan : keterangan,
          },
          // cache: false,
          success:function(data){
            $("#form-tambah-edit").trigger('reset');
            $("#btn_simpan").html('Simpan');

            swal("Good job!", "Data Berhasil Disimpan", "success");

          },
          error:function(data){
            console.log('error', data);
          }
        })
          }else{
            swal({
                title:"Maaf Data Harus Diisi"
            })
          }
         });
      });

      $("body").on('click', '.edit-post', function(){
        var id = $(this).data("id");
        // console.log(id);
        $.ajax({
          type: "get",
          url: "pemasukan/"+id+"/edit",
          data: {
            id:id,
          },
          dataType: "json",
          success: function (data) {
            $("#modal-judul").html('Edit Pemasukan');
            $("#modal_tambah_edit").modal('show');
            $("#btn_simpan").val('edit-post');

            $("#tanggal_pemasukan").val(data.tanggal_pemasukan);
            $("#uraian").val(data.uraian);
            $("#nominal_pemasukan").val(data.nominal_pemasukan);
            $("#keterangan").val(data.keterangan);

          },
          error:function(data){
            console.log('Error :', data);
          }
        });
      })

      $("body").on('click', '.delete', function(){
        var id = $(this).data('id');
        // console.log(id);

        confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ??');

        $.ajax({
          type: "delete",
          url: "/pemasukan/"+id,
          data: {
            id_pemasukan : id
          },
          dataType: "json",
          success: function (response) {
            swal("Berhasil !!", "Data Berhasil Dihapus", "success");b
          }
        });
      })


        });
    </script>
@endsection