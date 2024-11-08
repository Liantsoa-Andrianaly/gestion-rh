<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un paiement</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
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

    <div class="container mt-5">
        <h2 class="page-title" style="color:#227BFF; font-family:poppins;margin-left:350px">AJOUTER UN PAIEMENT</h2>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employe_id" style="color:#051946;font-family:poppins">Employé</label>
                <select name="employe_id" id="employe_id" class="form-control" required>
                    <option value="">Sélectionner un employé</option>
                    @foreach($employes as $employe)
                        <option value="{{ $employe->id }}">{{ $employe->nom }}  {{ $employe->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount" style="color:#051946;font-family:poppins">Montant</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01" required placeholder="Entrez le montant">
            </div>

            <div class="form-group">
                <label for="payment_date" style="color:#051946;font-family:poppins">Date de paiement</label>
                <input type="date" name="payment_date" id="payment_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('payments.index') }}" class="btn btn-warning">Annuler</a>
        </form>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @endsection
</body>
</html>
