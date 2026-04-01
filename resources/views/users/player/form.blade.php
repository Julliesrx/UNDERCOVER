@extends('template')

@section('title', 'Modifier mon compte')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; display: flex; flex-direction: column; align-items: center; padding-top: 20px;">

    <a href="{{ route('users.show', $user->id_user) }}" class="btn-retour">&lt;</a>

    <h2 class="profil-titre">MODIFIER PROFIL</h2>

    <div class="form-container">
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="group-champ">
                <label>Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom) }}">
            </div>

            <div class="group-champ">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}">
            </div>

            <div class="group-champ">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="group-champ">
                <label>Mot de passe (laisser vide si inchangé)</label>
                <input type="password" name="password" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-modifier-chic">Enregistrer</button>
        </form>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout-externe">Se déconnecter</button>
    </form>
</div>
@endsection