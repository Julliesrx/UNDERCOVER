@extends('administration') 

@section('title', 'Liste des users')

@section('content')

    <h1>Liste des users</h1>
    <a href="{{ route('users.create') }}">Ajouter un user</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($users as $user)
        <li>
            <div class="list-left">
                <p>Nom : {{ $user->nom }}</p>
                <p>Username : {{ $user->username }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Compte {{ $user->is_banned ? 'banni' : 'actif' }}</p>
            </div>
            <div class="list-right">
                <a href="{{ route('users.show', $user->id_user) }}">Voir</a>
                <a href="{{ route('users.edit', $user->id_user) }}">Modifier</a>
                <form action="{{ route('users.ban', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">{{ $user->is_banned ? 'Débannir' : 'Bannir' }}</button>
                </form>
                <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>Aucun user pour l'instant</li>
        @endforelse
    </ul>

@endsection