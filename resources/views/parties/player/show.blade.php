<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail d'une partie</title>
</head>
<body>
    <h1>Détail de la partie</h1>

    <p>{{ $partie->mot->mot1 }} | {{ $partie->mot->mot2 }}</p>
    <p>Gagnant : {{ $partie->role_gagnant ?? 'Partie en cours' }}</p>
    <p>{{ $partie->created_at->format('d/m/Y') }}</p>
    
    <h2>Joueurs</h2>
    <ul>
        @foreach($partie->joueurs as $joueur)
        <li>
            <p>{{ $joueur->nom }}</p>
            <p>Rôle : {{ $joueur->pivot->role }}</p>
            <p>Mot reçu : {{ $joueur->pivot->mot_recu ?? 'aucun' }}</p>
            <p>Score : {{ $joueur->pivot->score }}</p>
            <p>{{ $joueur->pivot->estGagnant ? 'Gagnant' : 'Perdant' }}</p>
        </li>
        @endforeach
    </ul>

    <a href="{{ route('parties.index') }}">Retour à la liste</a>
</body>
</html>