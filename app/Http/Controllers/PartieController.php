<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partie;
use App\Models\Mot;
use App\Models\Joueur;

class PartieController extends Controller
{
    public function index()
    {
        $parties = Partie::all();
        return view('parties.index', ['parties' => $parties]);
    }

    public function create()
    {
        $joueurs = Joueur::all();
        return view('parties.form', ['joueurs' => $joueurs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nbJoueurs' => 'required|integer|min:3',
            'nbUndercovers' => 'required|integer|min:1',
            'nbMrWhite' => 'required|integer|min:0',
            'option_mots' => 'required|in:base,perso,mix',
            'joueurs' => 'required|array|min:3',
        ]);

        // récupère une paire de mots de manière aléatoire et selon l'option choisie
        
        if ($request->option_mots == 'base') {
            $mot = Mot::whereNull('id_user')->inRandomOrder()->first();
        } elseif ($request->option_mots == 'perso') {
            $mot = Mot::whereNotNull('id_user')->inRandomOrder()->first();
        } else {
            $mot = Mot::inRandomOrder()->first();
        }

        // définition du mot undercover et civil 

        $mots = [$mot->mot1, $mot->mot2];
        shuffle($mots);

        $mot_civil = $mots[0];
        $mot_undercover = $mots[1];

        // création de la partie dans la bdd

        $partie = Partie::create([
            'nbJoueurs' => $request->nbJoueurs,
            'nbUndercovers' => $request->nbUndercovers,
            'nbMrWhite' => $request->nbMrWhite,
            'mot_civil' => $mot_civil,
            'mot_undercover' => $mot_undercover,
            'id_mots' => $mot->id_mots,
            'id_user' => auth()->id()
        ]);

        // attribution des rôles 

        $joueurs = $request->joueurs;
        shuffle($joueurs);

        foreach ($joueurs as $index => $id_joueur) {
            if ($index < $request->nbUndercovers) {
                $role = 'undercover';
                $mot_recu = $mot_undercover;
            } elseif ($index < $request->nbUndercovers + $request->nbMrWhite) {
                $role = "mrwhite";
                $mot_recu = null;
            } else {
                $role = 'civil';
                $mot_recu = $mot_civil;
            }

            // x_partir pour chaque joueur 
            
            $partie->joueurs()->attach($id_joueur, [
                'role' => $role,
                'mot_recu' => $mot_recu,
            ]);
        }

        return redirect()->route('parties.index')->with('success', 'Partie créée');
    }

    public function show(string $id)
    {
        $partie = Partie::with('joueurs')->findOrFail($id);
        // ajouter potentiellement les joueurs, mots etc ?

        return view('parties.show', ['partie' => $partie]);
    }

    public function edit(string $id)
    {
        // $partie = Partie::findOrFail($id);
        // // possible de editer ???
        // return view('parties.form', ['partie' => $partie]);
    }

    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'mot1' => 'required|string|max:50',
        //     'mot2' => 'required|string|max:50',
        //     // ajouter plus tard l'id du user authentifié ??
        // ]);

        // $mot = Mot::findOrFail($id);
        // $mot->update($request->all());

        // return redirect()->route('mots.index')->with('success', 'Paire de mots modifiée');
    }

    public function destroy(string $id)
    {
        $partie = Partie::findOrFail($id);
        $partie->delete();

        return redirect()->route('parties.index')->with('success', 'Partie supprimée !');
    }
}
