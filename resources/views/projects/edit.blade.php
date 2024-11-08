<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification du projet</title>
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


    <div class="container">
        <h2 class="page-title"  style="color:#227BFF;text-align:center;justify-content:center">Modifier le Projet : {{ $project->title }}</h2> <br>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titre du projet</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
            </div>
            <div class="form-group">
                <label for="price">Prix</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $project->price }}" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour le Projet</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
    

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @endsection
</body>
</html>
    