@extends('template')

@section('title', 'Mon compte')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; display: flex; flex-direction: column; align-items: center; padding-top: 20px;">

    <a href="{{ route('dashboard') }}" class="btn-retour">&lt;</a>

    <h2 class="profil-titre">MON COMPTE</h2>

    <div class="profil-card">
        <div class="info-ligne">
            <span class="info-label">Username</span>
            <span>{{ $user->username }}</span>
        </div>
        <div class="info-ligne">
            <span class="info-label">Nom</span>
            <span>{{ $user->nom }}</span>
        </div>
        <div class="info-ligne">
            <span class="info-label">Email</span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="info-ligne" style="border-bottom: none;">
            <span class="info-label">Statut</span>
            <span class="{{ $user->is_banned ? 'statut-banni' : 'statut-actif' }}">
                {{ $user->is_banned ? 'Banni' : 'Actif' }}
            </span>
        </div>

        <a href="{{ route('users.edit', $user->id_user) }}" class="btn-modifier-chic">Modifier</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout-externe">Se déconnecter</button>
    </form>
</div>
@endsection