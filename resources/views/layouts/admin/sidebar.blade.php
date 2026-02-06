<!-- Sidebar -->
<div class="position-sticky top-0 h-100" style="width: fit-content;">
    <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #38527E" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" target="_blank" href="{{ url('/') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-book"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Perpus SMPN 3 Tapango<sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            menu
        </div> 
        <li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>Kategori Buku</span></a>
        </li>
        <li class="nav-item {{ Request::is('books*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('books.index') }}">
                <i class="fas fa-fw fa-books"></i>
                <span>Katalog Buku</span></a>
        </li>
        <li class="nav-item {{ Request::is('peminjaman*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('peminjaman.index') }}">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Peminjaman</span></a>
        </li>
        <li class="nav-item {{ Request::is('students*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('students.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Siswa</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</div>
<!-- End of Sidebar -->
