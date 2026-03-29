<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;

class JoueurController extends Controller
{
    public function index()
    {
        $joueurs = Joueur::all();
        return view('joueurs.index', ['joueurs' => $joueurs]);
    }

    public function create()
    {
        $avatars = ["chat_1", "chat_2", "chat_3", "chat_4", "chat_5", "chat_6"];
        $couleurs = ["#6F347C", "#815CA7", "#5F7497", "#72B6A8", "#547641", "#B0BC78", "#EEC355", "#E39947", "#925833", "#E56999", "#F94245", "#9E9F9D"];

        return view('joueurs.form', compact('avatars', 'couleurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'avatar' => 'nullable|string|max:50',
            // ajouter plus tard le score total
        ]);

        Joueur::create([
            'nom' => $request->nom,
            'avatar' => $request->avatar,
            'couleur' => $request->couleur,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('joueurs.index')->with('success', 'Joueur ajouté');

    }

    public function show(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        $saisons = $joueur->saisons()->orderBy('date_debut', 'desc')->get();
        // ajouter potentiellement les parties jouées par ce joueur ?
        
        return view('joueurs.show', ['joueur' => $joueur, 'saisons' => $saisons]);
    }

    public function edit(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        $avatars = ["chat_1", "chat_2", "chat_3", "chat_4", "chat_5", "chat_6"];
        $couleurs = ["#6F347C", "#815CA7", "#5F7497", "#72B6A8", "#547641", "#B0BC78", "#EEC355", "#E39947", "#925833", "#E56999", "#F94245", "#9E9F9D"];

        return view('joueurs.form', compact('joueur', 'avatars', 'couleurs'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'avatar' => 'required|string|max:50',
            // ajouter plus tard le score total à garder
            // ajouter plus tard l'id du user authentifié et rectifier que ne peut pas être null
        ]);

        $joueur = Joueur::findOrFail($id);
        $joueur->update([
            'nom' => $request->nom,
            'avatar' => $request->avatar,
            'couleur' => $request->couleur,
        ]);

        return redirect()->route('joueurs.index')->with('success', 'Joueur modifié');
    }

    public function destroy(string $id)
    {
        $joueur = Joueur::findOrFail($id);
        $joueur->parties()->detach();
        $joueur->delete();

        return redirect()->route('joueurs.index')->with('success', 'Joueur supprimé !');
    }

    public function resetScore(string $id) 
    {
        $joueur = Joueur::findOrFail($id);
        $joueur->scoreTotal = 0;
        $joueur->save();

        return redirect()->route('users.show', $joueur->id_user)->with('success', 'Score réinitialisé !');
    }
}