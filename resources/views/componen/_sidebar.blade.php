<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-mosque"></i>
      </div>
      <div class="sidebar-brand-text mx-3">MASJID</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
   @if (Auth::user()->role == "admin")    
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-database"></i>&nbsp;
        <span>Data Master </span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('users.index') }}">Manajemen User</a>
          <a class="collapse-item" href="{{ route('penceramah.index') }}">Penceramah</a>
          <a class="collapse-item" href="{{ route('jenis_kegiatan.index') }}">Jenis Kegiatan</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visimisi" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>&nbsp;
        <span>Visi & Misi</span>
      </a>
      <div id="visimisi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('visi.index') }}">Visi</a>
          <a class="collapse-item" href="{{ route('misi.index') }}">Misi</a>
        </div>         
      </div>
    </li>


    <li class="nav-item">
      <a class="nav-link" href="{{ route('tentang.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tentang Masjid</span></a>
    </li>

   @endif 


      
   <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#keuangan" aria-expanded="true" aria-controls="collapseTwo">
       <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;
       <span>Keuangan</span>
     </a>
     <div id="keuangan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="{{ route('pemasukan.index') }}">Pemasukan</a>
         <a class="collapse-item" href="{{ route('pengeluaran.index') }}">Pengeluaran</a>
       </div>
       
     </div>
   </li>


   

 
   <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kegiatan" aria-expanded="true" aria-controls="collapseTwo">
       <i class="fas fa-fw fa-cog"></i>&nbsp;
       <span>Kegiatan</span>
     </a>
     <div id="kegiatan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="{{ route('kegiatan.index') }}">Kegiatan</a>
       </div>
       
     </div>
   </li>



      



    

    

    

    <!-- Divider -->
    <hr class="sidebar-divider">

   
   


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
