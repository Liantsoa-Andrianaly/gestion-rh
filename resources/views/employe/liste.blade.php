<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des employés</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script-->
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

    <!--script src="https://code.jquery.com/jquery-3.6.0.min.js"></script-->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
*{
    font-family: 'poppins', 'sans-serif';
    margin:0;
    padding:0;
    box-sizing:border-box;
}
    </style>
</head>
<body>
    @extends('layouts.template')
    @section('content')

    <div class="container text-center">
        
        <div class="row">
            <h2 class="page-title" style="color:#227BFF; font-family:poppins">Liste des employés</h2>
            <div class="mb-4">
            <div class="input-group" style="width:300px;">
                <input type="text" id="search-query" class="form-control" placeholder="Rechercher un employé" onkeyup="searchEmploye()">
            </div>
        </div>
            <a href="/ajouter" class="btn btn-primary mb-3" style="width:350px">Ajouter un employé</a>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div id="employe-table">
                <!-- Table des employés -->
                <table class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Date de naissance</th>
                            <th>Poste</th>
                            <th>Departement</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employe-list">
                        @foreach($employes as $employe)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employe->nom }}</td>
                                <td>{{ $employe->prenom }}</td>
                                <td>{{ $employe->date_naissance }}</td>
                                <td>{{ $employe->poste }}</td>
                                <td>{{ $employe->departement }}</td>
                                <td>{{ $employe->telephone }}</td>
                                <td>{{ $employe->adresses->first() ? $employe->adresses->first()->rue : '-' }}</td>
                                <td>
                                    <a href="/update-employe/{{$employe->id}}" style="font-size: 10px" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0);" style="font-size: 10px" class="btn btn-danger" onclick="confirmDelete({{ $employe->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employes->links() }}
            </div>
        </div>
    </div>

    <script>
        // Fonction de confirmation pour suppression
        function confirmDelete(employeId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "L'employé est supprimé!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/delete-employe/${employeId}`;
                }
            })
        }

        // Fonction de recherche
        function searchEmploye() {
            const query = $('#search-query').val().toLowerCase().trim(); // On récupère la requête et on la transforme en minuscule
            const rows = $('#employe-list tr');

            // Parcourir chaque ligne de la table
            rows.each(function() {
                const name = $(this).find('td:nth-child(2)').text().toLowerCase(); // Nom
                const prenom = $(this).find('td:nth-child(3)').text().toLowerCase(); // Prénom
                
                // Vérifier si le nom ou le prénom contient la requête
                if (name.includes(query) || prenom.includes(query)) {
                    $(this).show(); // Afficher la ligne si elle correspond
                } else {
                    $(this).hide(); // Masquer la ligne si elle ne correspond pas
                }
            });
        }
    </script>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @endsection
</body>
</html>
    