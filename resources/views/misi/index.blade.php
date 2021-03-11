@extends('layouts.global')

@section('judul')
    Misi Masjid
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1 mb-1">MISI MASJID</h2>                
                    </div>
                </div>
                <br>
              </div>
            </div>
  
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap m-2">
                            {{-- <i class="fas fa-user-plus"></i> --}}
                            <button class="btn btn-primary mb-1" id="btn_tambah_misi"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>
                    </div>
                </div>
                <br>
              </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered data" id="data_misi" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                          <tr>
                            {{-- <th width="30px">No</th> --}}
                            <th>No</th>
                            <th>Misi</th>
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


          {{-- modal misi --}}
          <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal_judul">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form_misi" action="{{ route('misi.store') }}" method="POST" class="form-group">
                    @csrf
                      <input type="hidden" name="id_misi" id="id_misi">
                      <label for="">Misi</label>
                      <textarea class="form-control" name="isi_misi" id="isi_misi" cols="30" rows="10" required></textarea>
                      <br>
                      <button type="submit" id="btn_simpan_misi" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>


          {{-- Konfirmasi Modal Delete --}}
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
                        <p>apakah anda yakin ingin meng-HAPUS?</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
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

            const datatable = $("#data_misi").DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('misi.index') }}",
                columns:[
                    {data:'id_misi', name:'id_misi'},
                    {data:'isi_misi', name:'isi_misi'},
                    {data:'action', name:'action'}
                ]
            })

            $("#btn_tambah_misi").click((e)=>{
                e.preventDefault();

                $("#form_misi").trigger("reset");
                $("#modal_judul").html("Tambah Misi");
                $("#modal_tambah").modal("show");
            })

            if($("#form_misi").length > 0){
                $("#form_misi").validate({
                    submitHaandler : function(form){
                        var actionType = $("#btn_simpan_misi").val();
                        $("#btn_simpan_misi").html("Sending...");

                        $.ajax({
                            type:"POST",
                            url: "{{ route('misi.store') }}",
                            data:$("#form_misi").serialize(),
                            dataType:"json",
                            success : function(data){
                                $("#form_misi").trigger("reset");
                                $("#modal_tambah").modal("hide");
                                $("#btn_simpan_misi").html("Simpan");

                                var table = $("#data_misi").dataTable();
                                table.fnDraw(false);
                                swal("Good Job", "Data Misi Berhasil Disimpan", "success");
                            },
                            error : function(data){
                                console.log("Error :", data);
                            }
                        })
                    }
                })
            }


            $("body").on("click", ".edit-post", function(){
                var id = $(this).data("id");
                // console.log(id);

                $.ajax({
                    type: "GET",
                    url: "misi/"+id+"/edit",
                    data: $("#form_misi").serialize(),
                    dataType: "json",
                    success: function (response) {
                        $("#modal_judul").html("Update Misi");
                        $("#btn_tambah_misi").html("Update");
                        $("#modal_tambah").modal("show");

                        $("#id_misi").val(response.id_misi);
                        $("#isi_misi").val(response.isi_misi);
                    },
                    error : function(data){
                        console.log("Error :", data);
                    }
                });
            })

            $("body").on("click", ".delete", function(e){
                e.preventDefault();
                var id = $(this).data("id");
                console.log(id);
            })
        });
    </script>
@endsection