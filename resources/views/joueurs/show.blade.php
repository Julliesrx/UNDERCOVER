<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du joueur</title>
</head>
<body>
    <h1>Détail du joueur</h1>

    <p>{{ $joueur->nom }}</p>
    <p>{{ $joueur->avatar }}</p>
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
    
    <form action="{{ route('joueurs.resetScore', $joueur->id_joueur) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit">Réinitialiser le score</button>
    </form>
    <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}">Modifier</a>
    <a href="{{ route('joueurs.index') }}">Retour à la liste</a>
</body>
</html>