<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Joueur;

class SaisonController extends Controller
{
    public function index()
    {
        $saisons = Saison::all();
        return view('saisons.index', ['saisons' => $saisons]);
    }

    public function create()
    {
        return view('saisons.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut'
        ]);

        Saison::create($request->all());

        return redirect()->route('saisons.index')->with('success', 'Saison créée !');
    }

    public function show(string $id)
    {
        $saison = Saison::findOrFail($id);
        $saison->load(['joueurs' => function($query) {
            $query->orderByPivot('score', 'desc');
        }]);
        return view('saisons.show', ['saison' => $saison]);
    }

    public function edit(string $id)
    {
        $saison = Saison::findOrFail($id);
        return view('saisons.form', ['saison' => $saison]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
        ]);

        $saison = Saison::findOrFail($id);
        $saison->update($request->all());

        return redirect()->route('saisons.index')->with('success', 'Saison modifiée !');
    }

    public function destroy(string $id)
    {
        $saison = Saison::findOrFail($id);
        $saison->joueurs()->detach();
        $saison->delete();

        return redirect()->route('saisons.index')->with('success', 'Saison supprimée !');
    }

    public function cloturer(string $id)
    {
        $saison = Saison::findOrFail($id);
        $saison->is_active = false;
        $saison->date_fin = now();
        $saison->save();

        Joueur::query()->update(['scoreTotal' => 0]);

        return redirect()->route('saisons.index')->with('success', 'Saison clôturée et scores réinitialisés !');
    }
}
