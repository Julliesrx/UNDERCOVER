<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'une saison</title>
</head>
<body>
    @if(isset($saison))
        <form action="{{ route('saisons.update', $saison->id_saison) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('saisons.store') }}" method="POST">
        @csrf
    @endif

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $saison->nom ?? '') }}">

        <label>Date de début</label>
        <input type="date" name="date_debut" value="{{ old('date_debut', $saison->date_debut ?? '') }}">

        <label>Date de fin</label>
        <input type="date" name="date_fin" value="{{ old('date_fin', $saison->date_fin ?? '') }}">

        <label>Active</label>
        <input type="checkbox" name="is_active" value="1" {{ isset($saison) && $saison->is_active ? 'checked' : '' }}>

        <button type="submit">{{ isset($saison) ? 'Modifier' : 'Créer' }}</button>

    </form>
</body>
</html>