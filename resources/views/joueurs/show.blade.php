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
    
    <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}">Modifier</a>
    <a href="{{ route('joueurs.index') }}">Retour à la liste</a>
</body>
</html>