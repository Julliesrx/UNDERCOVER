<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une partie</title>
</head>
<body>
    <h1>Créer une partie</h1>

    <form action="{{ route('parties.store') }}" method="POST">
        @csrf

        <label>Nombre de joueurs : <span id="nbJoueurs_val">3</span></label>
        <input type="range" name="nbJoueurs" min="3" max="15" value="3" oninput="document.getElementById('nbJoueurs_val').textContent = this.value">

        <label>Nombre d'undercovers</label>
        <input type="number" name="nbUndercovers" min="1" max="3" value="{{ old('nbUndercovers') }}">

        <label>Nombre de Mr White</label>
        <input type="number" name="nbMrWhite" min="0" max="1" value="{{ old('nbMrWhite') }}">

        <label>Option mots</label>
        <select name="option_mots">
            <option value="base">Mots de base</option>
            <option value="perso">Mots personnalisés</option>
            <option value="mix">Mix</option>
        </select>

        <label>Joueurs</label>
        @foreach($joueurs as $joueur)
            <div>
                <input type="checkbox" name="joueurs[]" value="{{ $joueur->id_joueur }}">
                <label>{{ $joueur->nom }}</label>
            </div>
        @endforeach

        <button type="submit">Créer la partie</button>
    </form>
</body>
</html>