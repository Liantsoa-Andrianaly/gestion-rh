<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Presence;
use Carbon\Carbon;

class PresenceController extends Controller
{
    /**
     * Afficher la fiche de présence pour la date du jour.
     */
    public function fiche_presence_du_jour()
{
    // Obtenir la date d'aujourd'hui
    $today = Carbon::today();

    // Obtenir la liste des employés
    $employes = Employe::all();

    // Vérifier s'il y a déjà une fiche de présence pour aujourd'hui
    $presences = Presence::whereDate('date', $today)->get(); // Récupérer toutes les présences pour aujourd'hui

    // Si aucune présence pour aujourd'hui, créer une fiche de présence pour chaque employé
    if ($presences->isEmpty()) {
        foreach ($employes as $employe) {
            Presence::create([
                'employe_id' => $employe->id,
                'date' => $today,
                'est_present' => true, // Par défaut, l'employé est marqué comme présent
            ]);
        }

        // Recharger les présences après création
        $presences = Presence::whereDate('date', $today)->paginate(8); // Utiliser paginate ici pour récupérer avec pagination
    } else {
        // Si des présences existent déjà, utilisez paginate ici si vous voulez la pagination
        $presences = Presence::whereDate('date', $today)->paginate(8);
    }

    return view('presence.fiche_du_jour', compact('presences', 'today'));
}


    /**
     * Enregistrer la fiche de présence soumise.
     */
    //public function enregistrer_presence(Request $request)
    //{
      //  foreach ($request->presences as $presenceId => $presenceData) {
        //    $presence = Presence::find($presenceId);
            
            // Mettre à jour la présence
          //  $presence->est_present = $presenceData['est_present'];
            
            // Motif seulement s'il est absent
            //if ($presenceData['est_present'] == 0) {
              //  $presence->motif = $presenceData['motif'] ?? 'Non spécifié'; // Ajouter le motif
            //} else {
              //  $presence->motif = null; // Aucun motif s'il est présent
            //}
            
            //$presence->save();
        //}

        //return redirect()->route('presences.liste')->with('status', 'Présences enregistrées avec succès !');
    //}

    /**
     * Afficher la liste des présences, groupées par date.
     */
    /**
 * Afficher la liste des présences, groupées par date.
 */
public function liste_presences(Request $request)
{
    // Initialiser la requête
    $query = Presence::with('employe')->orderBy('date', 'desc');

    // Vérifier si une date de recherche a été fournie
    if ($request->filled('search_date')) {
        $searchDate = $request->input('search_date');
        $query->whereDate('date', $searchDate);
    }

    // Paginer les résultats
    $presences = $query->paginate(8); // 8 présences par page

    return view('presence.liste', compact('presences'));
}

    /**
     * Mettre à jour le motif d'absence via une requête AJAX.
     */
    public function update_motif_ajax(Request $request)
    {

        
        // Valider les données
        $request->validate([
            'presence_id' => 'required|exists:presences,id',
            'motif' => 'required|string|max:255',
        ]);

        // Trouver la présence
        $presence = Presence::find($request->presence_id);

        // Si l'employé est absent, mettre à jour le motif
        if (!$presence->est_present) {
            $presence->motif = $request->motif;
            $presence->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function liste_absences(Request $request)
    {
        // Récupérer la date de recherche si elle est présente
        $searchDate = $request->input('search_date');
        
        // Construire la requête pour récupérer les absences
        $absencesQuery = Presence::with('employe')->where('est_present', false);

        // Si une date est fournie, filtrer par date
        if ($searchDate) {
            $absencesQuery->whereDate('date', $searchDate);
        }

        // Récupérer les absences et les paginer
        $absences = $absencesQuery->orderBy('date', 'desc')->paginate(7);

        return view('presence.liste_absences', compact('absences', 'searchDate'));
    }


    public function enregistrer_presence(Request $request)
    {
        // Valider les données d'entrée si nécessaire
        $request->validate([
            'presences.*.est_present' => 'required|boolean', // Validation pour s'assurer que est_present est un booléen
            'presences.*.motif' => 'nullable|string|max:255', // Validation pour le motif si présent
        ]);
    
        foreach ($request->presences as $presenceId => $presenceData) {
            $presence = Presence::find($presenceId);
    
            if ($presence) { // Vérifiez si la présence existe
                // Mettre à jour la présence
                $presence->est_present = $presenceData['est_present'];
    
                // Motif seulement s'il est absent
                if ($presenceData['est_present'] == 0) {
                    $presence->motif = $presenceData['motif'] ?? 'Non spécifié'; // Ajouter le motif
                } else {
                    $presence->motif = null; // Aucun motif s'il est présent
                }
    
                // Enregistrez les modifications dans la base de données
                $presence->save();
            }
        }
    
        // Rediriger avec un message de succès
        return redirect()->route('presences.liste')->with('status', 'Présences enregistrées avec succès !');
    }
    

}