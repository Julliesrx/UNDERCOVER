@extends('template')

@section('title', 'Mes joueurs')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/joueurs.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; padding-top: 20px;">

    <a href="{{ route('dashboard') }}" style="position: absolute; top: 10px; left: 15px; display: flex; justify-content: center; align-items: center; width: 35px; height: 35px; background-color: var(--violet-moyen); border-radius: 50%; color: white; text-decoration: none; font-weight: bold; font-size: 1.2rem;">&lt;</a>

    <h2 style="font-family: var(--titre); font-size: 2rem; color: var(--violet-foncé); text-align: center; margin-bottom: 25px;">LISTE DES JOUEURS</h2>

    <ul class="grille-joueurs">
        @foreach($joueurs as $joueur)
        <li class="carte-joueur">
            <p style="font-family: var(--titre); font-size: 1.2rem; color: var(--violet-foncé);">{{ $joueur->nom }}</p>

            <div class="avatar-conteneur" style="background-color: {{ $joueur->couleur }};">
                <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" alt="Avatar">
            </div>

            <p style="font-family: var(--corps); font-size: 0.9rem; font-weight: bold; color: var(--violet-moyen); margin-bottom: 10px;">{{ $joueur->scoreTotal }} pts</p>

            <div class="actions-joueur">
                <a href="{{ route('joueurs.show', $joueur->id_joueur) }}" class="btn-action-chic">Voir</a>
                <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}" class="btn-action-chic">Modifier</a>
                <form action="{{ route('joueurs.destroy', $joueur->id_joueur) }}" method="POST" style="margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action-chic btn-suppr" onclick="return confirm('Supprimer ?')">Suppr</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>

    <a href="{{ route('joueurs.create') }}" style="display: flex; justify-content: center; align-items: center; width: 55px; height: 55px; background-color: var(--violet-foncé); color: white; border-radius: 50%; font-size: 2rem; margin: 25px auto; text-decoration: none;">&plus;</a>
</div>
@endsection