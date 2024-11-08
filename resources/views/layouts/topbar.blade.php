
<nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color:#227BFF;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

   
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        

        <!-- Nav Item - Alerts -->
        

        <div class="topbar-divider d-none d-sm-block"></div>
         <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow" >
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 20px" >
                Mon compte   <i class="fa fa-angle-down hidden-side" style="margin-left: 15px"></i>

                
            </a>

            
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('profile.edit')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
               
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                       Deconnexion
                    </a>
                </form>
                
            </div>
        </li>

    </ul>

</nav>