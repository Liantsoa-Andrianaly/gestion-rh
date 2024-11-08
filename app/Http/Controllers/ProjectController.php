<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Project::create($request->all()); 
        return redirect()->route('projects.index')->with('success', 'Projet ajouté avec succès.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id); 
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all()); // Mettre à jour le projet
        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function markAsCompleted($id)
{
    $project = Project::findOrFail($id);

    // Vérifier si le projet n'est pas déjà marqué comme terminé
    if (!$project->is_completed) {
        $project->is_completed = true;
        $project->completed_at = now(); 
        $project->save(); 
        return redirect()->route('projects.index')->with('success', 'Le projet a été marqué comme terminé avec succès.');
    } else {
        return redirect()->route('projects.index')->with('info', 'Le projet est déjà terminé.');
    }
}

}
