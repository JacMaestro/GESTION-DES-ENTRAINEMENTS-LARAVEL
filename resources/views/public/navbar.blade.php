<ul class="navbar-nav ml-auto">
    <!-- Topbar Navbar --> 


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session()->get('firstname')}} {{ session()->get('lastname')}}</span>

 
            <img class="img-profile rounded-circle" src="{{asset('assets/img/user.svg')}}">
 

        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

            @if(session()->get('role') == 'admin')
 
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Paramètres
            </a>
            @else

            <a class="dropdown-item" href="">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Paramètres
            </a>

            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Déconnexion
            </a>
        </div>
    </li>

</ul>