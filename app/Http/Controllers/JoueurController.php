<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joueurs = Joueur::all();
        return view('joueurs.index', ['joueurs' => $joueurs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('joueurs.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'avatar' => 'nullable|string|max:50',
            // ajouter plus tard le score total
            // ajouter plus tard l'id du user authentifié et rectifier que ne peut pas être null
        ]);

        Joueur::create($request->all());

        return redirect()->route('joueurs.index')->with('success', 'Joueur ajouté');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        // ajouter potentiellement les parties jouées par ce joueur ?

        return view('joueurs.show', ['joueur' => $joueur]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $joueur = Joueur::findOrFail($id);
    
        return view('joueurs.form', ['joueur' => $joueur]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'avatar' => 'required|string|max:50',
            // ajouter plus tard le score total à garder
            // ajouter plus tard l'id du user authentifié et rectifier que ne peut pas être null
        ]);

        $joueur = Joueur::findOrFail($id);
        $joueur->update($request->all());

        return redirect()->route('joueurs.index')->with('success', 'Joueur modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        $joueur->delete();

        return redirect()->route('joueurs.index')->with('success', 'Joueur supprimé !');
    }
}
