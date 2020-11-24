<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a class="js-arrow" href="{{ url('/dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>                    
                </li>    
                @if (auth()->user()->role == 'admin')                    
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Data Master</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ url('/user') }}">Manajemen Users</a>
                        </li>
                        <li>
                            <a href="{{ url('/muadzin') }}">Data Muadzin</a>
                        </li> 
                        <li>
                            <a href="{{ url('/penceramah') }}">Data Pencceramah</a>
                        </li>                       
                    </ul>
                </li>

                                    
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-euro-sign"></i>Keuangan</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ url('/pemasukan') }}">Pemasukan</a>
                        </li>
                        <li>
                            <a href="{{ url('/pengeluaran') }}">Pegeluaran</a>
                        </li>                       
                    </ul>
                </li>

                <li>
                    <a class="js-arrow" href="{{ url('/kegiatan') }}">
                        <i class="fas fa-calendar-alt"></i>Kegiatan</a>                    
                </li> 

                @endif            
                
            </ul>
        </nav>
    </div>
</aside>