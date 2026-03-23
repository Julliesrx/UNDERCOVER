<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion/Inscription</title>
</head>
<body>
    @if(isset($user))
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('users.store') }}" method="POST">
        @csrf
    @endif

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}">

        <label>Username</label>
        <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}">

        <label>Mot de passe {{ isset($user) ? '(laisser vide pour ne pas modifier)' : '' }}</label>
        <input type="password" name="password">

        <button type="submit">{{ isset($user) ? 'Modifier' : 'Ajouter' }}</button>
    </form>
</body>
</html>