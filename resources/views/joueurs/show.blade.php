@extends('template') 

@section('title', 'Joueur ' . $joueur->nom)

@section('content')

<div id="content">
    <a href="{{ route('joueurs.index') }}" class="btn-retour" style="text-decoration: none; color: var(--violet-foncé); font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem; display: inline-block;"><</a>

    <h2 class="titre-page-mots">Détails du joueur</h2>

    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;">
        <div style="background-color: {{ $joueur->couleur }}; border-radius: 50%; width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: var(--ombre); border: 4px solid var(--violet-clair);">
            <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" alt="" style="width: 120px; object-fit: contain;">
        </div>
        
        <h1 style="font-family: var(--titre); font-size: 2.5rem; color: var(--violet-foncé); margin-top: 15px;">{{ $joueur->nom }}</h1>
        <p style="font-family: var(--corps); font-size: 1.2rem; font-weight: bold; background-color: var(--violet-clair); padding: 5px 20px; border-radius: 20px; color: var(--noir);">Total : {{ $joueur->scoreTotal }} pts</p>
    </div>

    <h2 class="soustitre-liste">Scores par saison</h2>
    <ul class="liste-mots-maquette">
        @forelse($saisons as $saison)
        <li class="mot-cadre" style="border-color: {{ $joueur->couleur }};">
            <span class="texte-mot">{{ $saison->nom }}</span>
            <span style="font-family: var(--corps); font-weight: bold; color: var(--violet-foncé);">{{ $saison->pivot->score }} pts</span>
        </li>
        @empty
        <li style="text-align: center; color: var(--violet-moyen);">Aucune saison jouée</li>
        @endforelse
    </ul>

    <div style="display: flex; justify-content: center; margin-top: 2rem;">
        <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}" style="background-color: var(--violet-foncé); color: var(--blanc); padding: 12px 30px; border-radius: 30px; text-decoration: none; font-family: var(--corps); font-weight: bold;">Modifier le joueur</a>
    </div>
</div>

@endsection