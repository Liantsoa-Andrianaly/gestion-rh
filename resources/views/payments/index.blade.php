<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des paiements</title>
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

    <div class="container text-center">
        
        <h2 class="page-title" style="color:#227BFF; font-family:poppins">Liste des paiements</h2>
        <hr>
        <p>Prochaine date de paiement : {{ $paymentDate->format('d-m-Y') }}</p>

        @if ($isPaymentDay)
            <a href="{{ route('payments.create') }}" class="btn btn-primary">Lancer les paiements</a>
        @else
            <div class="alert alert-danger">Le paiement ne peut être effectué qu'à la date de paiement.</div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employé</th>
                    <th>Montant</th>
                    <th>Date de paiement</th>
                    <th>Mois</th>
                    <th>Année</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ide = 1;
                @endphp

                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $ide }}</td>
                        <td>{{ $payment->employe->nom }} {{ $payment->employe->prenom }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                        <td>{{ $payment->month }}</td>
                        <td>{{ $payment->year }}</td>
                        <td style="color: green">{{ $payment->status }}</td>
                        <td>
                            <!--a href="{{ route('invoice.show', $payment->id) }}" class="btn btn-info btn-sm">Afficher</a-->
                            <!--a href="{{ route('invoice.download', $payment->id) }}" class="btn btn-success btn-sm">Télécharger</a-->
                            <a href="{{ route('payments.verify', $payment->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-check"></i></a>
                            </td>
                    </tr>

                    @php
                        $ide += 1;
                    @endphp
                @endforeach
            </tbody>
        </table>
        {{ $payments->links() }}
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @endsection
</body>
</html>
