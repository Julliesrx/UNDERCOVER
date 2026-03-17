<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des users</title>
</head>
<body>
    <h1>Liste des users</h1>
    <a href="{{ route('users.create') }}">Ajouter un user</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($users as $user)
        <li>
            <p>{{ $user->nom }}</p>
            <p>{{ $user->username }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->is_banned ? 'Banni' : 'Actif' }}</p>
            <div>
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
</body>
</html>