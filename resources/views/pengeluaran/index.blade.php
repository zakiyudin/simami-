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
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1 mb-1">Data Pengeluaran</h2>                
                            {{-- <i class="fas fa-user-plus"></i> --}}
                            <button class="btn btn-primary m-2" data-toggle="modal" data-target="#modal_tambah_edit" id="tambah_pengeluaran">Tambah</button>
                    </div>
                </div>
                <br>
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
            <!-- /.container-fluid -->


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


            //get data 
            $("#data_pengeluaran").DataTable({
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

            $("#tambah_pengeluaran").click(function(){
                $("#btn_simpan").val('create-post');
                $("#id_pengeluaran").val('');
                $("#form-tambah-edit").trigger('reset');
                $("#modal-judul").html('Tambah Pengeluaran');
                $("#modal_tambah_edit").modal("show");

                $("#btn_simpan").on('click', function(e){
                    e.preventDefault();

                    
                        var tanggal_pengeluaran = $("#tanggal_pengeluaran").val();
                        var uraian = $("#uraian").val();
                        var nominal_pengeluaran = $("#nominal_pengeluaran").val();
                        var keterangan = $("#keterangan").val();

                        if (tanggal_pengeluaran != '' && uraian != '' && nominal_pengeluaran != '' && keterangan != '') {
                            $("#btn_simpan").attr('disabled', 'disabled');
                            $.ajax({
                                type: "post",
                                url: "{{ route('pengeluaran.store') }}",
                                data: {
                                    tanggal_pengeluaran : tanggal_pengeluaran,
                                    uraian : uraian,
                                    nominal_pengeluaran : nominal_pengeluaran,
                                    keterangan : keterangan
                                },
                                dataType: "json",
                                success: function (data) {
                                    $("#form-tambah-edit").trigger('reset');
                                    $("#modal_tambah_edit").modal('hide');
                                    $("#btn_simpan").html('Simpan');

                                    swal("Good job!", "Data Berhasil Disimpan", "success");
                                },
                                error:function(data){
                                    console.log('error :', data);
                                }
                            });
                        }else{
                            swal("Error !", "Data Harus Diisi", "warning");
                        }
                    


                    
                })
            });




            $("body").on('click', '.edit-post', function(){
                var id = $(this).data('id');
                // console.log(id);
                $.ajax({
                    type: "get",
                    url: "pengeluaran/"+id+"/edit",
                    data:{id_pengeluaran:id},
                    dataType: "json",
                    success: function (data) {
                        $("#modal-judul").html('Edit Pengeluaran');
                        $("#btn_simpan").val('edit-post');
                        $("#modal_tambah_edit").modal('show');

                        $("#tanggal_pengeluaran").val(data.tanggal_pengeluaran);
                        $("#uraian").val(data.uraian);
                        $("#nominal_pengeluaran").val(data.nominal_pengeluaran);
                        $("#keterangan").val(data.keterangan);
                    }
                });
            })

            $('body').on('click', '.delete', function(){
                var id = $(this).data('id');
                // console.log(id);
                var konfirmasi = confirm('apakah anda yakin menghapus ??');
                
                $.ajax({
                    type: "delete",
                    url: "/pengeluaran/"+id+"destroy",
                    data: {id_pengeluaran : id},
                    dataType: "json",
                    success: function (data) {
                        swal('Good Job!', 'Data Berhasil Dihapus', 'success');
                    }
                });
            })

        
        });
    </script>
@endsection