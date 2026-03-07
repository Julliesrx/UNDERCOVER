<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la paire de mots</title>
</head>
<body>
    <h1>Détail de la paire de mots</h1>

    <p><strong>Mot 1 :</strong> {{ $mot->mot1 }}</p>
    <p><strong>Mot 2 :</strong> {{ $mot->mot2 }}</p>

    <a href="{{ route('mots.edit', $mot->id_mots) }}">Modifier</a>
    <a href="{{ route('mots.index') }}">Retour à la liste</a>
</body>
</html>