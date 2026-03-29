<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('undercover-favicon.png') }}">
    <link rel="stylesheet" href="https://use.typekit.net/jib5pzl.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <title>Undercover</title>
</head>
<body>
    <a href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('users.index') : route('dashboard')) : route('login') }}">
        <h1>UNDERCOVER</h1>
    </a>
</body>
</html>