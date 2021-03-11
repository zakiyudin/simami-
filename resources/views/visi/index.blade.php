@extends('layouts.global')

@section('judul')
    Visi
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($visi_jumlah == 0)
                    <button class="btn btn-primary" id="btn_tambah_visi">Tambah Visi</button>
                @endif
                @foreach ($visi as $item)
                    {{ $item->isi_visi }}
                    <br>
                    <br>
                    <button  class="btn btn-warning edit" data-id="{{ $item->id_visi }}" data-toggle="tooltip">Edit</button>
                @endforeach
            </div>
          </div>


          {{-- modal --}}
          <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal_judul">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form_visi" action="{{ route('visi.store') }}" method="POST" class="form-group">
                    @csrf
                      <input type="hidden" name="id_visi" id="id_visi">
                      <label for="">Visi</label>
                      <textarea class="form-control" name="isi_visi" id="isi_visi" cols="30" rows="10" required></textarea>
                      <br>
                      <button type="submit" id="btn_simpan_visi" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('extend_js')
    <script>
        $(document).ready(function () {
            $("#btn_tambah_visi").click((e) => {
                e.preventDefault();
                $("#moda_judull").html("Tambah Visi");
                $("#modal_tambah").modal("show");
            })

            // $(".edit").click(function(e){
            //     e.preventDefault();
            //     var id = $(this).data("id_visi");
            //     console.log(id);
            // })

            $("body").on("click", ".edit", function(){
                var id = $(this).data("id");
                // console.log(id);
                
                $.ajax({
                    type: "GET",
                    url: "visi/"+id+"/edit",
                    data: $("#form_visi").serialize(),
                    dataType: "json",
                    success: function (data) {
                        $("#modal_judul").html("Edit Visi");
                        $("#modal_tambah").modal("show");

                        $("#id_visi").val(data.id_visi);
                        $("#isi_visi").val(data.isi_visi);
                    },
                    error : function (data) { 
                        console.log("Error : ", data);
                     }
                });
            })


        });

        
    </script>
@endsection