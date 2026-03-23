<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mot;

class MotsController extends Controller
{
    public function index()
    {
        $mots = Mot::all();
        
        if(auth()->user()->role === 'admin') {
            return view('mots.admin.index', ['mots' => $mots]);
        } else {
            return view('mots.player.index', ['mots' => $mots]);
        }
    }

    public function create()
    {
        if(auth()->user()->role === 'admin') {
            return view('mots.admin.form');
        } else {
            return view('mots.player.form');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'mot1' => 'required|string|max:50',
            'mot2' => 'required|string|max:50',
        ]);

        Mot::create([
            'mot1' => $request->mot1,
            'mot2' => $request->mot2,
            'id_user' => auth()->user()->role === 'admin' ? null : auth()->id(),
        ]);

        return redirect()->route('mots.index')->with('success', 'Paire de mots ajoutée');
    }

    public function show(string $id)
    {
        // $mot = Mot::findOrFail($id);
        // // ajouter potentiellement les parties où la paire à été utilisée ?

        // return view('mots.show', ['mot' => $mot]);
    }

    public function edit(string $id)
    {
        // $mot = Mot::findOrFail($id);
    
        // return view('mots.form', ['mot' => $mot]);
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
        $mot = Mot::findOrFail($id);
        $mot->delete();

        return redirect()->route('mots.index')->with('success', 'Paire de mots supprimée !');
    }
}
