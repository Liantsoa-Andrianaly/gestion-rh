<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du Paiement</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"-->
        <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert.min.css') }}">

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"-->
    <link rel="stylesheet" href="{{ asset('assets/font/all.min.css') }}">


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
<br>
    <div class="container">
        <h2 class="page-title" style="color:#227BFF; margin-left:350px">Vérification du Paiement</h2><br>   
     
        <div class="card"> 
            <div class="card-body">

               <h5 class="page-title" style="color:#051946;" class="card-title" ><strong>Détails du Paiement</strong></h5><br>
                <p><strong>Employé :</strong> {{ $payment->employe->nom }} {{ $payment->employe->prenom }}</p>
                <p><strong>Departement:</strong> {{ $payment->employe->departement}}</p>
                <p><strong>Mois et Année:</strong> {{ $payment->month}} / {{ $payment->year}}</p>
                <p><strong>Montant :</strong> {{ number_format($payment->amount, 2, ',', ' ') }} Ariary</p>
                <p><strong>Date de paiement :</strong> {{ $payment->payment_date->format('d-m-Y') }}</p>
                <p><strong>Statut :</strong> {{ $payment->status }}</p>

                <!-- Formulaire de Vérification >
                <form action="{{ route('payments.verify', $payment->id) }}" method="POST" style="display: inline;" id="verify-form">
                    @csrf
                    <button type="button" class="btn btn-warning" onclick="confirmVerification()">Vérifier le Paiement</button>
                </form-->

                <!-- Bouton de Modification avec Confirmation -->

                <a href="{{ route('payments.index') }}" class="btn btn-secondary">Retour à la liste</a>
                <button class="btn btn-success" onclick="confirmEdit('{{ route('payments.edit', $payment->id) }}')">Modifier</button>
                <a href="{{ route('invoice.download', $payment->id) }}" style="" class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script-->
    <script src="{{ asset('assets/sweetalert2/sweetalert.min.js') }}"></script>


    <script>
        function confirmVerification() {
            swal({
                title: "Êtes-vous sûr?",
                text: "Vous allez vérifier ce paiement! Cette action ne peut pas être annulée.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, vérifier!",
                cancelButtonText: "Annuler",
                closeOnConfirm: false
            }, function() {
                document.getElementById('verify-form').submit();
            });
        }

        function confirmEdit(url) {
            swal({
                title: "Confirmez la modification",
                text: "Voulez-vous vraiment modifier ce paiement?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, modifier!",
                cancelButtonText: "Annuler",
                closeOnConfirm: false
            }, function() {
                window.location.href = url; // Redirige vers la page de modification
            });
        }

        @if(session('success'))
            swal("Succès!", "{{ session('success') }}", "success");
        @endif
    </script>
@endsection
</body>
</html>
