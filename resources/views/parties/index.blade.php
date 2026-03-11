<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des parties</title>
</head>
<body>
    <h1>Liste des parties</h1>
    <a href="{{ route('parties.create') }}">Créer une partie</a>

    <ul>
        @forelse($parties as $partie)
        <li>
            <p>{{ $partie->mot->mot1 }} | {{ $partie->mot->mot2 }}</p>
            <p>Gagnant : {{ $partie->role_gagnant ?? 'Partie en cours' }}</p>
            <p>{{ $partie->created_at->format('d/m/Y') }}</p>
            <div>
                <a href="{{ route('parties.show', $partie->id_partie) }}">Voir</a>
                <form action="{{ route('parties.destroy', $partie->id_partie) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>Aucune partie pour l'instant</li>
        @endforelse
    </ul>
</body>
</html>