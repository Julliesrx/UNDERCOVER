<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des saisons</title>
</head>
<body>
    <h1>Liste des saisons</h1>
    <a href="{{ route('saisons.create') }}">Créer une saison</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($saisons as $saison)
        <li>
            <p>{{ $saison->nom }}</p>
            <p>Début : {{ $saison->date_debut }}</p>
            <p>Fin : {{ $saison->date_fin ?? 'En cours' }}</p>
            <p>{{ $saison->is_active ? '🟢 Active' : '🔴 Clôturée' }}</p>
            <div>
                <a href="{{ route('saisons.show', $saison->id_saison) }}">Voir</a>
                <a href="{{ route('saisons.edit', $saison->id_saison) }}">Modifier</a>
                @if($saison->is_active)
                <form action="{{ route('saisons.cloturer', $saison->id_saison) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Clôturer</button>
                </form>
                @endif
                <form action="{{ route('saisons.destroy', $saison->id_saison) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>Aucune saison pour l'instant</li>
        @endforelse
    </ul>
</body>
</html>