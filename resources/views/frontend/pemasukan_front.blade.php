@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="card mt-5 mb-5">
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

            <div class="col-xl col-md-6 mb-4 mt-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Saldo Pemasukan</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_pemasukan }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="card-body">
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
@endsection

@section('extend_js')
    <script>
        $(document).ready(function () {
            const datatable = $("#data_pemasukan").DataTable({
                processing:false,
                serverSide:false,
                ajax:"{{ route('pemasukan_index') }}",
                columns:[
                    {data:'id_pemasukan', name:'id_pemasukan'},
                    {data:'tanggal_pemasukan', name:'tanggal_pemasukan'},
                    {data:'uraian', name:'uraian'},
                    {data:'nominal_pemasukan', name:'nominal_pemasukan'},
                    {data:'keterangan', name:'keterangan'},
                ]
              });
        });
    </script>
@endsection