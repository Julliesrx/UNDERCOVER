<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('undercover-favicon.png') }}">
    <link rel="stylesheet" href="https://use.typekit.net/jib5pzl.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    @if($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom') }}">

        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Mot de passe</label>
        <input type="password" name="password">

        <label>Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation">

        <button type="submit">S'inscrire</button>
    </form>

    <a href="{{ route('register') }}">Déjà un compte ? Se connecter</a>
</body>
</html>