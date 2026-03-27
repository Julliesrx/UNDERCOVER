@extends('dashboard') 

@section('title', 'Joueur {{ $joueur->nom }}')

@section('content')

    <h1>Détail du joueur</h1>

    <p>{{ $joueur->nom }}</p>
    <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background-color: {{ $joueur->couleur }};">
        <img src="{{ asset('avatars/' . $joueur->avatar . '.png') }}" alt="" style="width: 90px;">
    </div>
    <p>{{ $joueur->scoreTotal }}</p>

    <h2>Scores par saison</h2>
    <ul>
        @forelse($saisons as $saison)
        <li>
            <p>{{ $saison->nom }}</p>
            <p>Score : {{ $saison->pivot->score }}</p>
        </li>
        @empty
        <li>Aucune saison jouée</li>
        @endforelse
    </ul>
    
    <!-- <form action="{{ route('joueurs.resetScore', $joueur->id_joueur) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit">Réinitialiser le score</button>
    </form> -->
    <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}">Modifier</a>
    <a href="{{ route('joueurs.index') }}">Retour à la liste</a>

@endsection