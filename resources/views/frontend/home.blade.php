@extends('layouts.frontend')


@section('content')
    <div id="main">
        <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">
  
          <div class="section-title">
            <h2>Tentang Masjid</h2>
            @foreach ($tentang as $item)
            <p>{{ $item->isi_tentang }}</p>
            @endforeach
          </div>
  
          <div class="row">
            <div class="col-lg-6 order-1 order-lg-2">
              <img src="{{ asset('frontend/assets/img/masjid-about.jpeg') }}" class="img-fluid" alt="">
              <span class="text-center"><i>https://www.polresmojokerto.id/wp-content/uploads/2020/06/WhatsApp-Image-2020-06-20-at-18.54.14.jpeg</i></span>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
              <h3>VISI</h3>
              <p class="font-italic">
                @foreach ($visi as $item)
                    {{ $item->isi_visi }}
                @endforeach
              </p>
              <br>
              
              <h3>MISI</h3>
              @foreach ($misi as $item)    
              <ul>
                <li><i class="icofont-check-circled"></i>{{ $item->isi_misi }}</li>
              </ul>
              @endforeach


              
            </div>
          </div>
  
        </div>
      </section><!-- End About Us Section -->
    </div>
@endsection