@extends('administration') 

@section('title', 'Détails du user {{ $user->username }}')

@section('content')

    <a href="{{ route('users.index') }}"><</a>

    <h1>{{ $user->nom }}</h1>

    <p>Username : {{ $user->username }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Statut : {{ $user->is_banned ? 'Banni' : 'Actif' }}</p>

    <a href="{{ route('users.edit', $user->id_user) }}">Modifier</a>

    <h2>Joueurs de ce compte</h2>
    <ul>
        @forelse($user->joueurs as $joueur)
        <li>
            <p>{{ $joueur->nom }}</p>
            <p>{{ $joueur->scoreTotal }}</p>
            <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background-color: {{ $joueur->couleur }};">
                <img src="{{ asset('avatars/' . $joueur->avatar . '.png') }}" alt="">
            </div>
            <div>
                <form action="{{ route('joueurs.resetScore', $joueur->id_joueur) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Réinitialiser le score</button>
                </form>
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