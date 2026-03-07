<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des mots</title>
</head>
<body>
    <h1>Liste des paires de mots</h1>
    <a href="{{ route('mots.create') }}">Ajouter une paire de mots</a>

    <ul>
        @forelse($mots as $mot)
        <li>
            <p>{{ $mot->mot1 }} | {{ $mot->mot2 }}</p>
            <div>
                <a href="{{ route('mots.show', $mot->id_mots) }}">Voir</a>
                <a href="{{ route('mots.edit', $mot->id_mots) }}">Modifier</a>
                <form action="{{ route('mots.destroy', $mot->id_mots) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>
            Aucune paire de mots pour l'instant
        </li>
        @endforelse
    </ul>
</body>
</html>