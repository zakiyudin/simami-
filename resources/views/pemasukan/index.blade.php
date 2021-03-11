@extends('layouts.global')

@section('judul')
    Pemasukan
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Saldo Pemasukan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pemasukan }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                  <div class="overview-wrap">
                      <h2 class="title-1 mb-1">DATA PEMASUKAN</h2>                
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
                          <button class="btn btn-primary mb-1" id="tambah_pemasukan"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>

                          <a href="{{ route('excel') }}" class="btn btn-success mb-1" id="export_excel"><i class="fas fa-file-export"></i>&nbsp;Excel</a>

                          <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_cetak_pdf" id="cetak_pdf" class="btn btn-danger mb-1"><i class="fas fa-download"></i>&nbsp;PDF</a>
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
        </div>
            
    
    
           
    
    
              
            </div>
            <!-- /.container-fluid -->

            {{-- Modal cetak pdf --}}
            <div class="modal fade" id="modal_cetak_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak ke PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" class="form-group">
                      <label for="">Dari Tanggal</label>
                      <input type="date" name="tgl_awal" id="tgl_awal" class="form-control mb-2">
                      <label for="">Ke Tanggal</label>
                      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <a href="#" onclick="this.href='/pemasukan/print_pdf/'+document.getElementById('tgl_awal').value + '/' + document.getElementById('tgl_akhir').value" type="button" id="btn_cetak" class="btn btn-danger"><i class="fas fa-download"></i>&nbsp;Cetak</a>
                  </div>
                </div>
              </div>
            </div>
            {{-- akhir modal cetak pdf --}}


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
                        <input type="date" name="tanggal_pemasukan" id="tanggal_pemasukan" class="form-control" required>
                        <br>
              
                        <label for="">Uraian</label>
                        <textarea name="uraian" id="uraian" cols="30" rows="3" class="form-control" required></textarea>
                        <br>
              
                        <label for="">Nominal Pemasukan</label>
                        <input type="number" name="nominal_pemasukan" id="nominal_pemasukan" class="form-control" required>
                        <br>
              
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        <br>
              
                        <input type="submit" class="btn btn-primary" id="btn_simpan" value="Simpan"/>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


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
  

                                        {{-- <!-- Modal Update -->
              <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal-judul" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-judul">Update Pemasukan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" class="form-group" id="form-tambah-edit" method="">
                        @csrf
                        <input type="hidden" name="id_pemasukan" id="id_pemasukan_update" class="form-control">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal_pemasukan" id="tanggal_pemasukan_update" class="form-control">
                        <br>

                        <label for="">Uraian</label>
                        <textarea name="uraian" id="uraian_update" cols="30" rows="3" class="form-control"></textarea>
                        <br>

                        <label for="">Nominal Pemasukan</label>
                        <input type="number" name="nominal_pemasukan" id="nominal_pemasukan_update" class="form-control">
                        <br>

                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan_update" class="form-control">
                        <br>

                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" id="btn_update" value="update">UPDATE</button>
                    </div>
                  </div>
                </div>
              </div>
   --}}
    
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

            const datatable = $("#data_pemasukan").DataTable({
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

        $("#tambah_pemasukan").click(function(e){
          e.preventDefault();
          $("#btn_simpan").val("Simpan");
          $("#modal_tambah_edit").modal("show");
      });

      if($("#form-tambah-edit").length > 0){
        $("#form-tambah-edit").validate({
          submitHandler : function(form){
            var actionType = $("#btn_simpan").val();
            $("#btn_simpan").html("Sending...");

            $.ajax({
              type : "POST",
              url : "{{ route('pemasukan.store') }}",
              data : $("#form-tambah-edit").serialize(),
              dataType : "json",
              success : function(data){
                $("#form-tambah-edit").trigger("reset");
                $("#modal_tambah_edit").modal("hide");
                $("#btn_simpan").html("Simpan");
                var table = $("#data_pemasukan").dataTable();
                table.fnDraw(false);
                swal("Good job!", "Data Berhasil Disimpan", "success");
              },
              error : function(data){
                console.log('Error : ', data);
              }
            })
          }
        })
      }

      $("body").on('click', '.edit-post', function(){
        var id = $(this).data("id");

        $.ajax({
          type: "GET",
          url: "pemasukan/"+id+"/edit",
          data: $("#form-tambah-edit").serialize(),
          dataType: "json",
          success: function (data) {
            $("#modal-judul").html("Update Pemasukan");
            $("#btn_simpan").val("Update");
            $("#modal_tambah_edit").modal("show");


            $("#id_pemasukan").val(data.id_pemasukan);
            $("#tanggal_pemasukan").val(data.tanggal_pemasukan);
            $("#uraian").val(data.uraian);
            $("#nominal_pemasukan").val(data.nominal_pemasukan);
            $("#keterangan").val(data.keterangan);
          },
          error : function (data)
           {
            console.log("Error : ", data);
            }
        });       
      })


      $("body").on('click', '.delete', function(){
        id = $(this).data('id');
        $("#konfirmasi-modal").modal("show");
      });

      $("#tombol-hapus").click(function(){
        $.ajax({
          type: "DELETE",
          url: "pemasukan/"+id,
          data : $("#form-tambah-edit").serialize(),
          dataType: "json",
          success: function (data) {
            $("#konfirmasi-modal").modal("hide");
            var table = $("#data_pemasukan").dataTable();
            table.fnDraw(false);
            swal("Good job!", "Data Berhasil Disimpan", "success");
          },
          error : function (data) { 
            console.log("Error:", data);
           }
        });
      })


      // $("#btn_cetak").on('click', function(){
      //   var tgl_awal = $("#tgl_awal").val();
      //   var tgl_akhir = $("#tgl_akhir").val();

      //   console.log(tgl_awal, tgl_akhir);

      //   $.ajax({
      //     type: "get",
      //     url: "/pemasukan/print_pdf/"+tgl_awal+"/"+tgl_akhir,
      //     data: {
      //       tgl_awal : tgl_awal,
      //       tgl_akhir : tgl_akhir
      //     },
      //     dataType: "json",
      //     success: function (response) {
      //       console.log("berhasil");
      //     }
      //   });
      // })


        });
    </script>
@endsection