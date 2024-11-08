<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Adresse;

class EmployeController extends Controller
{
    public function liste_employe(){

        $employes = Employe::paginate(4);
        return view ('employe.liste', compact('employes'));
    }

    public function ajouter_employe(){
        return view ('employe.ajouter');
    }

    public function ajouter_employe_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required',
            'poste' => 'required',
            'departement' => 'required',
            'telephone' => 'required',
        ]);

        $employe = new Employe();
        $employe->nom = $request->nom;
        $employe->prenom = $request->prenom;
        $employe->date_naissance = $request->date_naissance;
        $employe->poste = $request->poste;
        $employe->departement = $request->departement;
        $employe->telephone = $request->telephone;
        $employe->salary = $request->salary ?? 0; 

        $employe->save();

        // Ajouter l'adresse de l'employé
    $employe->adresses()->create([
        'rue' => $request->rue,
        'ville' => $request->ville,
        'code_postal' => $request->code_postal,
        'pays' => $request->pays,
    ]);

        return redirect('/ajouter')->with('status', 'Employé a bien été  ajouté avec success');
        
    }

    public function update_employe($id){

        $employes = Employe::find($id);
        return view('employe.update', compact('employes'));
    }

    public function update_employe_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required',
            'poste' => 'required',
            'departement' => 'required',
            'telephone' => 'required',
            
            'rue' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
            'pays' => 'required',
    ]);
       

        $employe = Employe::find($request->id);
        $employe->nom = $request->nom;
        $employe->prenom = $request->prenom;
        $employe->date_naissance = $request->date_naissance;
        $employe->poste = $request->poste;
        $employe->departement = $request->departement;
        $employe->telephone = $request->telephone;
        $employe->update();

        $employe->adresses()->update([
            'rue' => $request->rue,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'pays' => $request->pays,
        ]);

        return redirect('/employe')->with('status', 'Employé a bien été  modifié');
    }

    public function delete_employe($id){
        $employe = Employe::findOrFail($id);
        $employe->delete();
        return redirect('/employe')->with('status', 'Employé a bien été  supprimé');

    }
    
    /*public function search(Request $request)
{
    $query = $request->input('query');

    // Effectuer la recherche dans la base de données
    $employes = Employe::where('nom', 'LIKE', "%{$query}%")
        ->orWhere('prenom', 'LIKE', "%{$query}%")
        ->orWhere('poste', 'LIKE', "%{$query}%")
        ->orWhereHas('adresses', function($q) use ($query) {
            $q->where('rue', 'LIKE', "%{$query}%")
              ->orWhere('ville', 'LIKE', "%{$query}%")
              ->orWhere('pays', 'LIKE', "%{$query}%");
        })
        ->paginate(10);

    return view('employe.liste', compact('employes'));
}*/




    
}
