<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>configuration</title>
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
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
        <div class="row">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status')}}
                </div>
            @endif

            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>
            
            <h2 class="page-title" style="text-align: center;align-items:center;color:#051946; font-size:40px">Nouvelle configuration</h2>
                <form action="{{route('configurations.store')}}" method="POST" class="form-group">
                    @csrf
                    @method('POST')
                    
                    <input type="text" name="id" style="display: none;" >

                    <div class="form-group">
                        <label for="type" class="form-label">Type de la configuration</label>
                        <select name="type" id="type" class="form-control">
                            <option value=""></option>
                            <option value="PAYMENT_DATE">Date de paiement</option>
                            <!--option value="APP_NAME">Nom de l'application</option>
                            <option value="DEVELOPPER_NAME">Equipe de développement</option>
                            <option value="ANOTHER">Autres options</option-->
                        </select>
                        @error('type')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="value" class="form-label">Valeur</label>
                        <input type="text" class="form-control" id="value" name="value" placeholder="Entrez la valeur">
                        @error('type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    

                    <button class="btn btn-primary" type="">Enregistrer</button>
                    <br><br>
                    <a href="{{route('configurations')}}" class="btn btn-danger">Revenir à la configuration</a>
                </form>
           
        
        
        </div>
    </div>
   
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script-->
    <script src="{{asset('asset/bootstrap/bootstrap.bundle.min.js')}}"></script>
@endsection
</body>
</html>