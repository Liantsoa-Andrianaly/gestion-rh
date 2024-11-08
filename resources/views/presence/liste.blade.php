<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listes de présence</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"-->
    <link rel="stylesheet" href="{{ asset('assets/font/all.min.css') }}">

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

    <h2 class="page-title" style="color:#227BFF; font-family:poppins; text-align:center;">Liste d'enregistrement</h2>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('presences.liste') }}" class="mb-3" id="search-form">
        <div class="input-group" style="width:350px">
            <input  type="date" name="search_date" class="form-control" placeholder="Rechercher par date" value="{{ request('search_date') }}" id="search-date">
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
                <th>Présent</th>
                <th>Motif d'absence</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
            <tr>
                <td>{{ $presence->employe->nom }}</td>
                <td>{{ $presence->employe->prenom }}</td>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->est_present ? 'Oui' : 'Non' }}</td>
                <td>
                    @if (!$presence->est_present)
                        @if ($presence->motif)
                            {{ $presence->motif }} <!-- Afficher le motif s'il existe -->
                        @else
                            <span>Aucun motif enregistré</span>
                        @endif
                    @else
                        <span>Aucun(e)</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Liens de pagination -->
    {{ $presences->links() }}
</div>

<script>
    document.getElementById('search-date').addEventListener('change', function() {
        document.getElementById('search-form').submit();
    });
</script>
@endsection
</body>
</html>
