@extends('administration') 

@section('title', 'Liste des paires de mots')

@section('content')

<div id="content">
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