<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mot;

class MotsController extends Controller
{
    public function index()
    {
        $mots = Mot::all();
        return view('mots.index', ['mots' => $mots]);
    }

    public function create()
    {
        return view('mots.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mot1' => 'required|string|max:50',
            'mot2' => 'required|string|max:50',
            // ajouter plus tard l'id du user authentifié et rectifier que ne peut pas être null
        ]);

        Mot::create($request->all());

        return redirect()->route('mots.index')->with('success', 'Paire de mots ajoutée');
    }

    public function show(string $id)
    {
        $mot = Mot::findOrFail($id);
        // ajouter potentiellement les parties où la paire à été utilisée ?

        return view('mots.show', ['mot' => $mot]);
    }

    public function edit(string $id)
    {
        $mot = Mot::findOrFail($id);
    
        return view('mots.form', ['mot' => $mot]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'mot1' => 'required|string|max:50',
            'mot2' => 'required|string|max:50',
            // ajouter plus tard l'id du user authentifié ??
        ]);

        $mot = Mot::findOrFail($id);
        $mot->update($request->all());

        return redirect()->route('mots.index')->with('success', 'Paire de mots modifiée');
    }

    public function destroy(string $id)
    {
        $mot = Mot::findOrFail($id);
        $mot->delete();

        return redirect()->route('mots.index')->with('success', 'Paire de mots supprimée !');
    }
}
