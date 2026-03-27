@extends('dashboard') 

@section('title', 'Mes joueurs')

@section('content')

    <h1>Liste des joueurs</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <a href="{{ route('joueurs.create') }}">Ajouter un joueur</a>

    <ul>
        @forelse($joueurs as $joueur)
        <li>
            <p>{{ $joueur->nom }}</p>
            <p>{{ $joueur->scoreTotal }}</p>
            <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background-color: {{ $joueur->couleur }};">
                <img src="avatars/{{ $joueur->avatar }}.png" alt="" style="width: 90px;">
            </div>
            <div>
                <!-- <form action="{{ route('joueurs.resetScore', $joueur->id_joueur) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Réinitialiser le score</button>
                </form> -->
                <a href="{{ route('joueurs.show', $joueur->id_joueur) }}">Voir</a>
                <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}">Modifier</a>
                <form action="{{ route('joueurs.destroy', $joueur->id_joueur) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>
            Aucun joueur pour l'instant
        </li>
        @endforelse
    </ul>

@endsection