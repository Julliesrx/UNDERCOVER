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
    <title>Connexion</title>
</head>
<body>
    
    <img src="/logo/undercover-logo.png" alt="Logo Undercover">
    <div class="carte-login">
        <h1 class="titre-main">Connexion</h1>

        @if($errors->any())
            <p style="color: red ; margin-bottom: 15px ; font-weight: bold ;">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <input type="email" name="email" class="champ-saisie" placeholder="Email" value="{{ old('email') }}" required>

            <input type="password" name="password" class="champ-saisie" placeholder="Mot de passe" required>

            <button type="submit" class="btn-valider">Se connecter</button>
        </form>

        <p style="margin-top: 20px ;">
            <a href="{{ route('register') }}" style="color: var(--violet-moyen) ; font-weight: 600 ; text-decoration: none ;">Pas de compte ? Créer un compte</a>
        </p>
    </div>
</body>
</html>