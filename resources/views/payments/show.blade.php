<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Paiement</title>
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



    <div class="row">

        <h2 class="page-title" style="color:#227BFF;">Détails du Paiement</h2>
        <p>Employé : {{ $payment->employe->nom }} {{ $payment->employe->prenom }}</p>
        <p>Montant : {{ number_format($payment->amount, 2, ',', ' ') }} Ariary</p>
        <p>Date de paiement : {{ $payment->payment_date->format('d-m-Y') }}</p>
        <p>Statut : {{ $payment->status }}</p>

        <a href="{{ route('payments.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
@endsection
</body>
</html>
