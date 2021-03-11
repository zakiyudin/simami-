@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row mt-5 mb-5">
        @foreach ($kegiatan as $item)
            <div class="col-sm-12 mb-2">
                <div class="card">
                    <div class="card-header">
                    Kegiatan
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p>{{ $item->deskripsi }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $kegiatan->links() }}
</div>
@endsection