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
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    
    <title>Inscription - Undercover</title>
</head>
<body>
    <img src="/logo/undercover-logo.png" alt="Logo Undercover">

    <div class="carte-login" style="margin-top: 5vh ;">
        <h1 class="titre-main">INSCRIPTION</h1>

        @if($errors->any())
            <p style="color: red ; margin-bottom: 15px ; font-weight: bold ;">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <input type="text" name="nom" class="champ-saisie" placeholder="Ton nom" value="{{ old('nom') }}" required autofocus>

            <input type="text" name="username" class="champ-saisie" placeholder="Ton pseudo" value="{{ old('username') }}" required>

            <input type="email" name="email" class="champ-saisie" placeholder="Email" value="{{ old('email') }}" required>

            <input type="password" name="password" id="password" class="champ-saisie" placeholder="Mot de passe" required>

            <input type="password" name="password_confirmation" id="password_confirmation" class="champ-saisie" placeholder="Confirme le mot de passe" required>

            <button type="submit" class="btn-valider">CRÉER MON COMPTE</button>
        </form>

        <p style="margin-top: 20px ;">
            <a href="{{ route('login') }}" style="color: var(--violet-moyen) ; font-weight: 600 ; text-decoration: none ;">Déjà un compte ? Se connecter</a>
        </p>
    </div>
</body>
</html>