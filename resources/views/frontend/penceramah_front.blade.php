@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="card mt-5 mb-5">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1 mb-1">DATA PENCERAMAH</h2>                
                    </div>
                </div>
                <br>
              </div>
            </div>
  
            <div class="card-body">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered data" id="data_penceramah" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                          <tr>
                            {{-- <th width="30px">No</th> --}}
                            <th>No</th>
                            <th>Nama Penceamah</th>
                            <th>Alamat</th>
                            <th>NO HP</th>
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
            const datatable = $("#data_penceramah").DataTable({
                processing:false,
                serverSide:false,
                ajax:"{{ route('penceramah_index') }}",
                columns:[
                    {data:'id_penceramah', name:'id_penceramah'},
                    {data:'nama_penceramah', name:'nama_penceramah'},
                    {data:'alamat_penceramah', name:'alamat_penceramah'},
                    {data:'no_hp_penceramah', name:'no_hp_penceramah'},
                ]
              });
        });
    </script>
@endsection