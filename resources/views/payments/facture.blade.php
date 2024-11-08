<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de paie</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
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
    border: none; 
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

.transaction-box {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 25px; /* Espacement intérieur */
    background-color: #f7f7f7; /* Fond gris clair */
    margin-bottom: 30px; /* Espacement en bas */
}

.item {
    display: flex; /* Utilisation de Flexbox */
    justify-content: space-between; /* Espace égal entre les éléments */
    margin-bottom: 15px; /* Espacement entre les éléments */
}

.label {
    font-weight: bold; /* Police en gras */
    color: #051946; /* Couleur légèrement grise */
    flex: 1; /* Prend l'espace disponible */
}

.value {
    color: black; /* Couleur de texte foncée */
    flex: 1; /* Prend l'espace disponible */
    text-align: right; /* Alignement à droite */
}


.right {
    margin-top: 30px; /* Espacement supérieur */
}

table {
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 20px;/
}

table th, table td {
    padding: 12px; 
    text-align: left; 
    border: 1px solid #7f8c8d; 
}

table thead {
    background-color: #2980b9; /* Couleur de fond bleue */
    color: white; /* Couleur du texte blanche */
}

.single_item {
    display: flex; /* Flexbox */
    justify-content: space-between; /* Espace égal */
    padding: 8px 0; /* Espacement */
}

.single_item span {
    font-weight: bold; /* Mettre en gras */
}

/* Totaux */
.total-row {
    font-weight: bold; /* Mettre en gras */
    background-color: #7f8c8d; /* Fond gris clair pour les totaux */
}

    </style>
   
<body>
    <div class="container">
        
        <div class="text-center">
            <b class="font-monospace">Facture de paiement</b>
        </div>

        <div class="transaction-box">
            <div class="item">
                <div class="label">Identifiant un employé</div>
                <div class="value">{{ $payment->employe->id }}</div>
            </div>

            <div class="item">
                <div class="label">Nom et prénom</div>
                <div class="value">{{ $payment->employe->nom }} {{ $payment->employe->prenom }}</div>
            </div>

            <div class="item">
                <div class="label">Departement</div>
                <div class="value">{{ $payment->employe->departement}}</div>
            </div>

            <div class="item">
                <div class="label">Mois & Année</div>
                <div class="value">{{ $payment->month}} / {{ $payment->year}}</div>
            </div>
        </div>

        <div class="right">
            <table class="table table-bordered">
                <thead>
                    <th>Date de paiement</th>
                    <th>Montant de paiement</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="single_item">
                                <span>Total</span>
                                <span class="value">Montant du paiement - Ariary</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="single_item">
                                <span>Total frais</span>
                                <span class="value">0</span>
                            </div>
                            <div class="single_item">
                                <span>Total payé</span>
                                <span class="value">{{ $payment->amount }}</span>
                            </div>
                            <div class="single_item">
                                <span>Reste à payé</span>
                                <span class="value">0</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{asset('asset/bootstrap/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
