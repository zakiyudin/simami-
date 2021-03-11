@extends('layouts.global')

@section('judul')
    Tentang
@endsection

@section('extend_css')
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($tentang_jumlah == 0)
                    <button class="btn btn-primary" id="btn_tambah_tentang">Tambah Tentang</button>
                @endif
                @foreach ($tentang as $item)
                    {{ $item->isi_tentang }}
                    <br>
                    <br>
                    <button  class="btn btn-warning edit" data-id="{{ $item->id_tentang }}" data-toggle="tooltip">Edit</button>
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
                  <form id="form_visi" action="{{ route('tentang.store') }}" method="POST" class="form-group">
                    @csrf
                      <input type="hidden" name="id_tentang" id="id_tentang">
                      <label for="">Tentang</label>
                      <textarea class="form-control" name="isi_tentang" id="isi_tentang" cols="30" rows="10" required></textarea>
                      <br>
                      <button type="submit" id="btn_simpan_tentang" class="btn btn-primary">Simpan</button>
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
            $("#btn_tambah_tentang").click((e) => {
                $("#modal-judul").html("Tambah Tentang");
                $("#modal_tambah").modal("show");
            })


            $("body").on("click", ".edit", function(){
                var id = $(this).data("id");
                // console.log(id);
                
                $.ajax({
                    type: "GET",
                    url: "tentang/"+id+"/edit",
                    data: $("#form_visi").serialize(),
                    dataType: "json",
                    success: function (data) {
                        $("#modal_judul").html("Edit Tentang");
                        $("#modal_tambah").modal("show");

                        $("#id_tentang").val(data.id_tentang);
                        $("#isi_tentang").val(data.isi_tentang);

                    },
                    error : function (data) { 
                        console.log("Error : ", data);
                     }
                });
            })
        });    
    </script>    
@endsection