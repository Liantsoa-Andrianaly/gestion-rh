<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Projets</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
        * {
            font-family: 'poppins', 'sans-serif';
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    @extends('layouts.template')
    @section('content')

    <div class="container">
        <h2 class="page-title" style="color:#227BFF; text-align:center;justify-content:center">Liste des Projets</h2><br>

        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Ajouter un Projet</a>

        <div class="card">
            <div class="card-header">Projets</div>
            <div class="card-body">
                @if($projects->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre du projet</th>
                                <th>Prix (en Ariary)</th>
                                <th>État</th>
                                <th>Date de complétion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ number_format($project->price, 0, ',', ' ') }} Ar</td>
                                    <td>{{ $project->is_completed ? 'Terminé' : 'En cours' }}</td>
                                    <td>
                                        @if($project->is_completed)
                                            {{ \Carbon\Carbon::parse($project->completed_at)->format('Y-m-d ') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('projects.complete', $project->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" {{ $project->is_completed ? 'disabled' : '' }}>Marquer comme terminé</button>
                                        </form>
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Aucun projet trouvé.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @endsection
</body>
</html>
