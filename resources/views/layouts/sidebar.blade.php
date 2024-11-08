       

 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"style="background-color:#227BFF">

    <!-- Divider -->
    <img src="{{asset('/img/Idea noir.png')}}" alt="" style="width: 150px; height:60px; margin-left:40px">
    <br>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
          <hr class="sidebar-divider my-0">
    

    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="margin-left: 15px">  Dashboard</span></a>
    </li>

    <!-- Divider -->

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span style="margin-left: 20px">Employé</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/ajouter">Ajout un(e) employé(e)</a>
                <a class="collapse-item" href="/employe">Listes des employés</a>
            </div>
        </div>
    </li>
    

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-calendar-check"></i>
            <span  style="margin-left: 20px">Présence</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('presences.fiche_du_jour')}}">Fiche de présence</a>
                <a class="collapse-item" href="{{route('presences.liste')}}">Liste d'enregistrement</a>
                <a class="collapse-item" href="{{route('presences.liste_absences')}}">Liste d'absence</a>

                
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-clipboard"></i>
            <span style="margin-left: 20px">Projets</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('projects.index')}}">Liste des projets</a>
                <a class="collapse-item" href="{{route('projects.create')}}">Ajouter un projet</a>
            </div>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{route('payments.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span style="margin-left: 15px">Paiements</span></a>
    </li>


   

   