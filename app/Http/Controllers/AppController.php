<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Configuration;
use App\Models\Project;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
{
    // Récupérer le nombre total d'employés
    $totalEmployes = Employe::count();

    // Récupérer tous les projets terminés
    $totalProjects = Project::where('is_completed', true)->count();
    $totalProjectPrice = floatval(Project::where('is_completed', true)->sum('price')); // Montant total des projets


    $currentMonthPayments = Payment::whereMonth('paid_at', now()->month)
                                    ->whereYear('paid_at', now()->year)
                                    ->sum('amount');


    $remainingProjectPrice = $totalProjectPrice - $currentMonthPayments;


    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    $sum = DB::table('payments')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');
   
    // Initialiser la notification de paiement
    $paymentNotification = "";

    // Récupérer la date actuelle
    $currentDate = Carbon::now()->day;

    // Récupérer la configuration de la date de paiement
    $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();

    if ($defaultPaymentDateQuery) {
        $defaultPaymentDate = intval($defaultPaymentDateQuery->value);

        // Vérifier si la date de paiement est future ou passée
        if ($currentDate < $defaultPaymentDate) {
            $currentMonthName = Carbon::now()->translatedFormat('F'); // Mois actuel en français
            $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " de ce mois de " . $currentMonthName . ".";
        } else {
            $nextMonth = Carbon::now()->addMonth();
            $nextMonthName = $nextMonth->translatedFormat('F'); // Mois suivant en français
            $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " du mois de " . $nextMonthName . ".";
        }
    } else {
        // Gérer le cas où la configuration n'est pas trouvée
        $paymentNotification = "Configuration de la date de paiement non trouvée.";
    }

    // Passer les variables à la vue
    return view('dashboard', compact('totalEmployes','sum', 'currentMonth', 'currentYear', 'totalProjects', 'paymentNotification', 'remainingProjectPrice', 'currentMonthPayments'));
}


}
