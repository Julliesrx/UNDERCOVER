<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
</head>
<body>
    <h1>{{ $user->nom }}</h1>

    <p>Username : {{ $user->username }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Statut : {{ $user->is_banned ? 'Banni' : 'Actif' }}</p>

    <a href="{{ route('users.edit', $user->id_user) }}">Modifier</a>
    <a href="{{ route('users.index') }}">Retour à la liste</a>
</body>
</html>