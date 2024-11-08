<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Absences</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"-->
    <link rel="stylesheet" href="{{ asset('assets/font/all.min.css') }}">

    <!--script src="https://code.jquery.com/jquery-3.6.0.min.js"></script-->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>

    <!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script-->
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

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

<div class="container">
    <h2 class="page-title" style="color:#227BFF; font-family:poppins; text-align:center;">Liste des absences</h2>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('presences.liste_absences') }}" class="mb-3" id="search-form">
        <div class="input-group" style="width:350px">
            <input type="date" name="search_date" class="form-control" placeholder="Rechercher par date" value="{{ request('search_date') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
                <th>Motif d'absence</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
            <tr>
                <td>{{ $absence->employe->nom }}</td>
                <td>{{ $absence->employe->prenom }}</td>
                <td>{{ $absence->date }}</td>
                <td>
                    <input type="text" id="motif_{{ $absence->id }}" value="{{ $absence->motif ?? '' }}" placeholder="Motif d'absence">
                </td>
                <td>
                    <button type="button" onclick="enregistrerMotif({{ $absence->id }})" class="btn btn-primary">Enregistrer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Liens de pagination -->
    {{ $absences->links() }}
</div>

<script>
    function enregistrerMotif(absenceId) {
        var motif = $('#motif_' + absenceId).val();
        
        // Afficher une boîte de dialogue pour confirmation avec SweetAlert2
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Voulez-vous enregistrer le motif pour l'absence ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, enregistrer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur clique sur "Oui, enregistrer", lancer la requête AJAX
                $.ajax({
                    url: "{{ route('presences.update_motif_ajax') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        presence_id: absenceId,
                        motif: motif
                    },
                    success: function(response) {
    if (response.success) {
        // Remplacer le champ du motif par le texte statique
        $('#motif_' + absenceId).replaceWith('<span id="motif_' + absenceId + '">' + motif + '</span>');
        
        // Masquer le bouton d'enregistrement après succès
        $('button[onclick="enregistrerMotif(' + absenceId + ')"]').fadeOut();

        // Message de succès
        Swal.fire({
            icon: 'success',
            title: 'Motif enregistré !',
            text: 'Le motif d\'absence a été enregistré.',
            confirmButtonText: 'OK'
        });
    } else {
        // En cas d'erreur lors de l'enregistrement
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur est survenue lors de l\'enregistrement du motif.',
            confirmButtonText: 'Réessayer'
        });
    }
},

                    error: function(xhr, status, error) {
                        console.error('Erreur :', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Une erreur technique est survenue.',
                            confirmButtonText: 'Réessayer'
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Si l'utilisateur clique sur "Annuler"
                Swal.fire({
                    icon: 'info',
                    title: 'Annulation',
                    text: 'L\'enregistrement du motif a été annulé.',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
</script>

@endsection
</body>
</html>
