<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Joueur</title>
</head>
<body>
    
    @if(isset($joueur))
        <form action="{{ route('joueurs.update', $joueur->id_joueur) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('joueurs.store') }}" method="POST">
        @csrf
    @endif
            <input type="text" name="nom" value="{{ old('nom', $joueur->nom ?? '') }}">
            <input type="text" name="avatar" value="{{ old('avatar', $joueur->avatar ?? '') }}">
            <!-- input hidden avec l'id du compte et rectifier dans bdd peut pas etre null -->
            <button type="submit">{{ isset($joueur) ? 'Modifier' : 'Ajouter' }}</button>   
        </form>
</body>
</html>