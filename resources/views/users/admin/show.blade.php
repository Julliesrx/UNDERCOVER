@extends('dashboard') 

@section('title', 'Détails du user {{ $user->username }}')

@section('content')

    <h1>{{ $user->nom }}</h1>

    <p>Username : {{ $user->username }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Statut : {{ $user->is_banned ? 'Banni' : 'Actif' }}</p>

    <a href="{{ route('users.edit', $user->id_user) }}">Modifier</a>
    <a href="{{ route('users.index') }}">Retour à la liste</a>

@endsection