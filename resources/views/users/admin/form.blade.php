@extends('administration')

@section('title', isset($user) ? 'Modifier user' : 'Ajouter user')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; display: flex; flex-direction: column; align-items: center; padding-top: 20px;">

    <a href="{{ route('users.index') }}" class="btn-retour">&lt;</a>

    <h2 class="profil-titre">{{ isset($user) ? 'MODIFIER' : 'AJOUTER' }} USER</h2>

    <div class="form-container">
        <form action="{{ isset($user) ? route('users.update', $user->id_user) : route('users.store') }}" method="POST">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="group-champ">
                <label>Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}">
            </div>

            <div class="group-champ">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}">
            </div>

            <div class="group-champ">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}">
            </div>

            <div class="group-champ">
                <label>Mot de passe {{ isset($user) ? '(optionnel)' : '' }}</label>
                <input type="password" name="password">
            </div>

            <button type="submit" class="btn-modifier-chic">
                {{ isset($user) ? 'Modifier' : 'Ajouter' }}
            </button>
        </form>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout-externe">Se déconnecter</button>
    </form>
</div>
@endsection