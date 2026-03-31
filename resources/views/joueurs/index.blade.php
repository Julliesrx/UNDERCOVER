@extends('template')

@section('title', 'Mes joueurs')

@section('content')

<div id="content">
    <a href="{{ route('dashboard') }}" class="btn-retour" style="text-decoration: none; color: var(--violet-foncé); font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem; display: inline-block;">
        << /a>

            <h2 class="titre-page-mots">liste des joueurs</h2>

            @if(session('success'))
            <p class="alerte-succes">{{ session('success') }}</p>
            @endif

            <ul class="grille-joueurs">
                @forelse($joueurs as $joueur)
                <li class="carte-joueur">

                    <p class="nom-joueur">{{ $joueur->nom }}</p>

                    <div class="avatar-conteneur" style="background-color: {{ $joueur->couleur }};">
                        <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" alt="Avatar">
                    </div>

                    <p class="score-joueur">{{ $joueur->scoreTotal }} pts</p>

                    <div class="actions-joueur">
                        <a href="{{ route('joueurs.show', $joueur->id_joueur) }}" class="link-action">Voir</a>

                        <a href="{{ route('joueurs.edit', $joueur->id_joueur) }}" class="link-action">Modifier</a>

                        <form action="{{ route('joueurs.destroy', $joueur->id_joueur) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-action btn-supprimer-text" onclick="return confirm('Supprimer ce joueur ?')">Supprimer</button>
                        </form>
                    </div>
                </li>
                @empty
                <li style="grid-column: span 2; text-align: center; color: var(--violet-moyen);">Aucun joueur.</li>
                @endforelse
            </ul>

            <a href="{{ route('joueurs.create') }}" class="btn-ajout-flottant">+</a>
</div>

@endsection