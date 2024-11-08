<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Configuration;
use App\Models\Payment;
use App\Models\Project;

use Carbon\Carbon;
use PDF;

class PaymentController extends Controller
{
    public function index()
{
    // Obtenez la date de paiement de la configuration

    //$payments = Payment::paginate(4);

    $configPaymentDay = \DB::table('configurations')->where('type', 'PAYMENT_DATE')->value('value');

    // Date actuelle
    $currentDate = \Carbon\Carbon::now();

    // Formez une date complète à partir de l'année et du mois actuels
    
    $paymentDate = \Carbon\Carbon::createFromDate($currentDate->year, $currentDate->month, $configPaymentDay);

    // Si la date de paiement est déjà passée, ajoutez un mois pour obtenir la prochaine date
    if ($currentDate->greaterThan($paymentDate)) {
        $paymentDate->addMonth();
    }

    // Vérifiez si c'est le jour de paiement
    $isPaymentDay = $currentDate->isSameDay($paymentDate);

    // Récupérer tous les paiements
    $payments = Payment::with('employe')->paginate(6);
    
    // Retourner la vue avec les variables nécessaires
    return view('payments.index', compact('payments', 'paymentDate', 'isPaymentDay'));
}


    public function create()
    {
        // Récupérer tous les employés pour le formulaire
        $employes = Employe::all();
        return view('payments.create', compact('employes'));
    }

    /*public function store(Request $request)
{
    /* Valider les données
    $request->validate([
        'employe_id' => 'required|exists:employes,id',
        'amount' => 'required|numeric',
        'paid_at' => now(),
    ]);

    $payment = new Payment();
    $payment -> employe_id = $request->employe_id;
    $payment -> amount = $request->amont;
    $payment -> paid_at = now();
    $payment -> save();





    /* Extraire le mois et l'année de la date de paiement
    $paymentDate = Carbon::parse($request->payment_date);
    $month = $paymentDate->month;
    $year = $paymentDate->year;

    // Créer un nouveau paiement
    $payment = Payment::create([
        'employe_id' => $request->employe_id,
        'amount' => $request->amount,
        'payment_date' => $request->payment_date,
        'month' => $month,
        'year' => $year,
        'status' => 'completed',
    ]);

    // Récupérer l'employé pour obtenir le projet
    $employe = Employe::find($request->employe_id);
    $project = Project::find($employe->project_id); // Assurez-vous que 'project_id' est correct

    if ($project) {
        // Réduire le prix total du projet
        $newPrice = $project->price - $payment->amount;
        $project->update(['price' => $newPrice]);
    }

    $message = "Paiement créé pour le {$month}ème mois {$year}.";

    // Rediriger vers le tableau de bord
    return redirect()->route('dashboard')->with('success', $message);
}*/

public function store(Request $request)
{
    // Valider les données entrantes
    $request->validate([
        'employe_id' => 'required|exists:employes,id',
        'amount' => 'required|numeric',
    ]);

    // Créer un nouveau paiement
    $payment = new Payment();
    $payment->employe_id = $request->employe_id;
    $payment->amount = $request->amount; 
    $payment->paid_at = now(); 
    $payment->payment_date = now(); 
    $payment->month = now()->month; 
    $payment->year = now()->year; 
    $payment->status = 'completed'; 

    $payment->save();

    // Récupérer l'employé pour obtenir le projet
    $employe = Employe::find($request->employe_id);
    if ($employe) {
        $project = Project::find($employe->project_id);

        if ($project) {
            $newPrice = $project->price - $payment->amount;
            $project->update(['price' => $newPrice]);

            $message = "Le montant restant est maintenant disponible après avoir payé {$payment->amount} MGA.";
        } else {
            $message = "{$employe->prenom} {$employe->nom} a déjà été payé ce mois ";
        }
    } else {
        $message = "Employé non trouvé.";
    }

    // Rediriger vers le tableau de bord avec un message de succès
    return redirect()->route('dashboard')->with('success', $message);
}





    

    public function downloadInvoice($paymentId)
    {
        $payment = Payment::with('employe')->find($paymentId);

        if (!$payment) {
            return redirect()->back()->withErrors(['message' => 'Payment not found.']);
        }

        // Générer le PDF
        $pdf = PDF::loadView('payments.facture', compact('payment'));

        // Télécharger le PDF
        return $pdf->download('facture_' . $payment->employe->prenom . '.pdf');
    }    

    public function show($id)
{
    $payment = Payment::with('employe')->find($id);

    if (!$payment) {
        return redirect()->back()->with('error', 'Paiement non trouvé.');
    }
    $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date);


    return view('payments.show', compact('payment'));
}

    
public function verifyInvoice($id)
{
    $payment = Payment::with('employe')->find($id);

    if (!$payment) {
        return redirect()->back()->with('error', 'Paiement non trouvé.');
    }

    // Convertir payment_date en un objet Carbon
    $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date);

    return view('payments.verify', compact('payment'));
}

public function update(Request $request, $id)
{
    $payment = Payment::find($id);

    if (!$payment) {
        return redirect()->back()->withErrors(['message' => 'Paiement non trouvé.']);
    }

    $request->validate([
        'amount' => 'required|numeric',
        'payment_date' => 'required|date',
    ]);

    $payment->amount = $request->amount;
    $payment->payment_date = $request->payment_date;
    $payment->save();

    return redirect()->route('payments.index')->with('success', 'Le paiement a été modifié avec succès.');
}

public function edit($id)
{
    $payment = Payment::find($id);
    
    if (!$payment) {
        return redirect()->route('payments.index')->withErrors(['message' => 'Paiement non trouvé.']);
    }

    $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date);

    return view('payments.edit', compact('payment'));
}




}
