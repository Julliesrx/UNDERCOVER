@extends('administration')

@section('title', 'Détails de ' . $user->username)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; display: flex; flex-direction: column; align-items: center; padding-top: 20px;">

    <a href="{{ route('users.index') }}" class="btn-retour">&lt;</a>

    <h2 class="profil-titre">{{ $user->username }}</h2>

    <div class="profil-card">
        <div class="info-ligne">
            <span class="info-label">Nom</span>
            <span>{{ $user->nom }}</span>
        </div>
        <div class="info-ligne">
            <span class="info-label">Email</span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="info-ligne">
            <span class="info-label">Statut</span>
            <span class="{{ $user->is_banned ? 'statut-banni' : 'statut-actif' }}">
                {{ $user->is_banned ? 'Banni' : 'Actif' }}
            </span>
        </div>

        <h3 class="section-titre" style="margin-top: 20px; font-family: var(--titre); font-size: 1.2rem;">JOUEURS</h3>
        <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
            @forelse($user->joueurs as $joueur)
            <li class="item-joueur" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; background: var(--rose); padding: 10px; border-radius: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: {{ $joueur->couleur }}; overflow: hidden;">
                    <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span style="flex: 1; font-weight: bold;">{{ $joueur->nom }}</span>
                <form action="{{ route('joueurs.destroy', $joueur->id_joueur) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action-chic btn-suppr" style="font-size: 0.6rem;">Suppr</button>
                </form>
            </li>
            @empty
            <li>Aucun joueur</li>
            @endforelse
        </ul>

        <a href="{{ route('users.edit', $user->id_user) }}" class="btn-modifier-chic">Modifier User</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout-externe">Se déconnecter</button>
    </form>
</div>
@endsection