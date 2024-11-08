<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture de Paiement</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
*{
    font-family: 'poppins', 'sans-serif';
    margin:0;
    padding:0;
    box-sizing:border-box;
}
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #34495e;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .text-center {
            margin-bottom: 20px;
        }

        .font-monospace {
            font-size: 28px;
            font-weight: bold;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #051946;
            flex: 1;
        }

        .value {
            color: #ecf0f1;
            flex: 1;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #7f8c8d;
        }

        table thead {
            background-color: #2980b9;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <b class="font-monospace">Facture de Paiement</b>
        </div>

        <div class="item">
            <div class="label">Identifiant Employé</div>
            <div class="value">{{ $payment->employe->id }}</div>
        </div>

        <div class="item">
            <div class="label">Nom et Prénom</div>
            <div class="value">{{ $payment->employe->nom }} {{ $payment->employe->prenom }}</div>
        </div>

        <div class="item">
            <div class="label">Département</div>
            <div class="value">{{ $payment->employe->departement }}</div>
        </div>

        <div class="item">
            <div class="label">Mois & Année</div>
            <div class="value">{{ $payment->month }} / {{ $payment->year }}</div>
        </div>

        <div class="right">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date de Paiement</th>
                        <th>Montant de Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->amount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <a href="{{ route('invoice.download', $payment->id) }}" class="btn btn-primary">Télécharger la Facture</a>
            <a href="{{ route('payments.index') }}" class="btn btn-danger">Retour à la liste</a>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
