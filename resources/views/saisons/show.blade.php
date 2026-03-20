<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la saison</title>
</head>
<body>
    <h1>{{ $saison->nom }}</h1>

    <p>Date de début : {{ $saison->date_debut }}</p>
    <p>Date de fin : {{ $saison->date_fin ?? 'En cours' }}</p>
    <p>Statut : {{ $saison->is_active ? '🟢 Active' : '🔴 Clôturée' }}</p>

    <h2>Classement des joueurs</h2>
    <ul>
        @forelse($saison->joueurs as $joueur)
        <li>
            <p>{{ $joueur->nom }}</p>
            <p>Score : {{ $joueur->pivot->score }}</p>
            <a href="{{ route('joueurs.show', $joueur->id_joueur) }}">Voir le joueur</a>
        </li>
        @empty
        <li>Aucun joueur pour cette saison</li>
        @endforelse
    </ul>

    <a href="{{ route('saisons.edit', $saison->id_saison) }}">Modifier</a>
    <a href="{{ route('saisons.index') }}">Retour à la liste</a>
</body>
</html>