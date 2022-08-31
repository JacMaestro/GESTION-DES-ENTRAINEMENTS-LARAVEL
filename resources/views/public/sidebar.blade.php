<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <!-- <img width="39px" height="39px" src="{{asset('assets/img/logo.jpeg')}}" style="border-radius: 10px;" /> -->
        </div>
        <div class="sidebar-brand-text mx-3">As Craponne<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @php if(session()->get('role') == 'admin') { @endphp

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Utilisateurs
    </div>

    <li class="nav-item {{ Request::routeIs('lists.users') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lists.users')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Liste des joueurs</span>
        </a>
    </li>

    <li class="nav-item {{ Request::routeIs('addGamers') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('addGamers')}}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Ajouter des joueurs</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    @php } else { @endphp

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="/player/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
    </li>
    <hr class="sidebar-divider">


    @php } @endphp

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->