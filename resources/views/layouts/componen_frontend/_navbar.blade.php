<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="#">MAKBADUL MUTTAQIN</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li><a href="{{ route('pemasukan_index') }}">Pemasukan</a></li>
          <li><a href="{{ route('pengeluaran_index') }}">Pegeluaran</a></li>
          <li><a href="{{ route('penceramah_index') }}">Daftar Penceramah</a></li>
          <li><a href="{{ route('kegiatan_index') }}">Kegiatan</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="{{ route('login') }}" class="get-started-btn scrollto">LOGIN</a>

    </div>
  </header><!-- End Header -->
