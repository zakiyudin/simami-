@extends('layouts.global')

@section('judul')
    Pengeluaran
@endsection

@section('extend_css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
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
            
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Saldo Pengeluaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pengeluaran }}</div>
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
                                <h2 class="title-1 mb-1">Data Pengeluaran</h2>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary m-2" id="tambah_pengeluaran"><i class="fas fa-plus-square"></i>&nbsp;Tambah</button>

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_cetak_pdf" id="cetak_pdf" class="btn btn-danger mb-1"><i class="fas fa-download"></i>&nbsp;PDF</a>
                        </div>
                    </div>

                     <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data" id="data_pengeluaran" width="100%" cellspacing="0">
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
                      <form action="" class="form-group" id="form-tanggal-awal-akhir">
                        <label for="">Dari Tanggal</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control mb-2">
                        <label for="">Ke Tanggal</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <a href="#" onclick="this.href='/pengeluaran/print_pdf/'+document.getElementById('tgl_awal').value + '/' + document.getElementById('tgl_akhir').value" type="button" id="btn_cetak" class="btn btn-danger"><i class="fas fa-download"></i>&nbsp;Cetak</a>
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
                    <h5 class="modal-title" id="modal-judul">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form action="" class="form-group" id="form-tambah-edit">
                        @csrf
                        <input type="hidden" name="id_pengeluaran" id="id_pengeluaran" class="form-control">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran" class="form-control">
                        <br>
            
                        <label for="">Uraian</label>
                        <textarea name="uraian" id="uraian" cols="30" rows="3" class="form-control"></textarea>
                        <br>
            
                        <label for="">Nominal pengeluaran</label>
                        <input type="number" name="nominal_pengeluaran" id="nominal_pengeluaran" class="form-control">
                        <br>
            
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control">
                        <br>
            
                        <button type="submit" class="btn btn-primary" id="btn_simpan" value="create">Simpan</button>
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


            //get data 
            const datatable = $("#data_pengeluaran").DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('pengeluaran.index') }}",
                columns:[
                    {data:'id_pengeluaran', name:'id_pengeluaran'},
                    {data:'tanggal_pengeluaran', name:'tanggal_pengeluaran'},
                    {data:'uraian', name:'uraian'},
                    {data:'nominal_pengeluaran', name:'nominal_pengeluaran'},
                    {data:'keterangan', name:'keterangan'},
                    {data:'action', name:'action'}
                ]
            });

            $("#cetak_pdf").click(function(e){
                e.preventDefault();
                $("#form-tanggal-awal-akhir").trigger("reset");
            })

            $("#tambah_pengeluaran").click(function(e){
                e.preventDefault();
                $("#modal_tambah_edit").modal("show");
            });

            if($("#form-tambah-edit").length > 0){
                $("#form-tambah-edit").validate({
                    submitHandler : function (form) { 
                        var actionType = $("#btn_simpan").val();
                        $("#btn_simpan").html("Sending");

                        $.ajax({
                            type: "POST",
                            url: "{{ route('pengeluaran.store') }}",
                            data: $("#form-tambah-edit").serialize(),
                            dataType: "json",
                            success: function (data) {
                                $("#form-tambah-edit").trigger("reset");
                                $("#modal_tambah_edit").modal("hide");
                                $("#btn_simpan").html("simpan");

                                var table = $("#data_pengeluaran").dataTable();
                                table.fnDraw(false);
                                swal("Good job!", "Data Berhasil Disimpan", "success");
                            },
                            error : function(data){
                                console.log("error :", data);
                            }
                        });
                     }
                })
            }
            


            $("body").on('click', '.edit-post', function(){
                var id = $(this).data('id');
                // console.log(id);
                $.ajax({
                    type: "get",
                    url: "pengeluaran/"+id+"/edit",
                    data:$("#form-tambah-edit").serialize(),
                    dataType: "json",
                    success: function (data) {
                        $("#modal-judul").html('Edit Pengeluaran');
                        $("#btn_simpan").val('Update');
                        $("#modal_tambah_edit").modal('show');

                        $("#id_pengeluaran").val(data.id_pengeluaran);
                        $("#tanggal_pengeluaran").val(data.tanggal_pengeluaran);
                        $("#uraian").val(data.uraian);
                        $("#nominal_pengeluaran").val(data.nominal_pengeluaran);
                        $("#keterangan").val(data.keterangan);
                    }
                });
            })

            $('body').on('click', '.delete', function(){
                id = $(this).data("id");
                console.log(id);
               $("#konfirmasi-modal").modal("show");
            });

            $("#tombol-hapus").click(function(){
                $.ajax({
                    type: "DELETE",
                    url: "pengeluaran/"+id,
                    data: $("#form-tambah-edit").serialize(),
                    dataType: "json",
                    success: function (data) {
                        $("#konfirmasi-modal").modal("hide");
                        var table = $("#data_pengeluaran").dataTable();
                        table.fnDraw(false);
                        swal("Good job!", "Data Berhasil Disimpan", "success");
                    },
                    error : function(data){
                        console.log("Error :", data);
                    }
                });
            })

        
        });
    </script>
@endsection