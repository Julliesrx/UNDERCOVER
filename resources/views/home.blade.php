<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undercover</title>
</head>
<body>
    <h1>Bienvenue {{ auth()->user()->nom }} !</h1>

    <nav>
        <a href="{{ route('joueurs.index') }}">Mes joueurs</a>
        <a href="{{ route('mots.index') }}">Mes mots</a>
        <a href="{{ route('parties.index') }}">Mes parties</a>
        <a href="{{ route('saisons.show', 1) }}">Saison en cours</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </nav>
</body>
</html>