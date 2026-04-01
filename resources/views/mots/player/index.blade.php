@extends('template') 

@section('title', 'Banque de mots')

@section('content')

<div id="content">
    <a href="{{ route('dashboard') }}" class="btn-retour" style="text-decoration: none; color: var(--violet-foncé); font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem; display: inline-block;"><</a>

    <h2 class="titre-page-mots">modifier la liste de mots</h2>


    <ul class="liste-mots-maquette">
        @forelse($mots as $mot)
        <li class="mot-cadre">
            <span class="texte-mot">{{ $mot->mot1 }} / {{ $mot->mot2 }}</span>
            
            <a href="{{ route('mots.edit', $mot->id_mots) }}" class="btn-trois-points">⋮</a>
        </li>
        @empty
        <li style="text-align: center; width: 100%; color: var(--violet-moyen); padding: 20px; border: none;">
            Aucune paire de mots pour l'instant
        </li>
        @endforelse
    </ul>

    <a href="{{ route('mots.create') }}" class="btn-ajout-flottant">+</a>
</div>

@endsection