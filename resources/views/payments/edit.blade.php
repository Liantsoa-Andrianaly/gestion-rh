<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Paiement</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"-->
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert.min.css') }}">


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
<br><br>
    <div class="container">
        <h2 class="page-title" style="color:#227BFF; margin-left:350px">Modifier le Paiement</h2><br><br>

        <form action="{{ route('payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="amount" style="color:#051946;">Montant :</label>
                <input type="number" name="amount" id="amount" value="{{ $payment->amount }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_date" style="color:#051946;">Date de paiement :</label>
                <input type="date" name="payment_date" id="payment_date" value="{{ $payment->payment_date->format('Y-m-d') }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Modifier le Paiement</button>
            
        </form>
    <br>
                <form action="{{ route('payments.verify', $payment->id) }}" method="POST" style="display: inline;"> 
                    @csrf
                    <button type="submit" class="btn btn-warning">Vérifier le Paiement</button>
                </form>    
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script-->
    <script src="{{ asset('assets/sweetalert2/sweetalert.min.js') }}"></script>


    @if(session('success'))
        <script>
            swal("Succès!", "{{ session('success') }}", "success");
        </script>
    @endif
@endsection
</body>
</html>
