@extends('dashboard') 

@section('title', 'Mon compte')

@section('content')

    <h1>{{ $user->username }}</h1>

    <p>Username : {{ $user->username }}</p>
    <p>Nom : {{ $user->nom }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Statut : {{ $user->is_banned ? 'Banni' : 'Actif' }}</p>

    <a href="{{ route('users.edit', $user->id_user) }}">Modifier</a>

@endsection