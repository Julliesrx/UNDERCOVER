<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenue {{ auth()->user()->nom }} !</h1>

    <nav>
        <a href="{{ route('users.index') }}">Users</a>
        <a href="{{ route('joueurs.index') }}">Joueurs</a>
        <a href="{{ route('mots.index') }}">Mots</a>
        <a href="{{ route('parties.index') }}">Parties</a>
        <a href="{{ route('saisons.index') }}">Saisons</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </nav>
</body>
</html>