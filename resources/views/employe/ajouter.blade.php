<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout des employés</title>
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

            <h2 class="page-title" style="text-align: center;align-items:center; color:#227BFF;font-size:40px" >Ajouter un(e) employé(e)</h2> 
              
                <form action="/ajouter/traitement" method="POST" class="form-group">
                    
                    @csrf
                    

                    <!--div class="form-group">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" >
                    </div>

                    <div class="form-group">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" >
                    </div-->

                    <div class="row">
                        <div class="col">
                            <label for="nom" class="form-label" style="color:#051946;font-family:poppins">Nom</label>
                            <input type="text" class="form-control" placeholder="Entrez votre nom" id="nom" name="nom" >
                        </div>
                        <div class="col">
                            <label for="prenom" class="form-label" style="color:#051946;font-family:poppins">Prénom</label>
                            <input type="text" class="form-control" placeholder="Entrez votre prénom" id="prenom" name="prenom">
                        </div>
                    </div>
                    <br>

                    

                    <div class="row">
                        <div class="col">
                            <label for="poste" class="form-label" style="color:#051946;font-family:poppins">Poste</label>
                            <input type="text" class="form-control" id="poste" name="poste">
                        </div>
    
                        <div class="col">
                            <label for="departement" class="form-label" style="color:#051946;font-family:poppins">Département</label>
                            <input type="text" class="form-control" id="departement" name="departement">
                        </div>
                    </div>
                   <br>

                   <div class="row">
                        <div class="col">
                            <label for="date_naissance" class="form-label" style="color:#051946;font-family:poppins">Date de naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" >
                        </div>
    
                         <div class="col">
                            <label for="telephone" class="form-label" style="color:#051946;font-family:poppins">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" >
                        </div>
                   </div>

               
<br>
                    <h2 style="text-align: center;align-items:center; color:#227BFF;font-size:40px">Adresse de l'employé</h2>

                    <div class="row">
                        <div class="col">
                            <label for="rue" class="form-label" style="color:#051946;font-family:poppins">Rue</label>
                            <input type="text" class="form-control" id="rue" name="rue" required>
                        </div>
        
                        <div class="col">
                            <label for="ville" class="form-label" style="color:#051946;font-family:poppins">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" required>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col">
                            <label for="code_postal" class="form-label" style="color:#051946;font-family:poppins">Code postal</label>
                            <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                        </div>
        
                        <div class="col">
                            <label for="pays" class="form-label" style="color:#051946;font-family:poppins">Pays</label>
                            <input type="text" class="form-control" id="pays" name="pays" required>
                        </div>
                    </div>
                
                <br>
            

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" type="">Ajouter un(e) employé(e)</button>
                        </div>
                        <div class="col">
                            <a href="/employe" class="btn btn-danger">Revenir à la liste des employés</a>

                        </div>
                    
                    </div>
                  
                </form>
           
        
        
        </div>
    </div>
   
    
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script-->
    <script src="{{asset('asset/bootstrap/bootstrap.bundle.min.js')}}"></script>
@endsection
</body>
</html>