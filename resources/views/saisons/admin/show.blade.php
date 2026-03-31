@extends('administration') 

@section('title', 'Détails de la saison')

@section('content')

<div id="content">
    <a href="{{ route('saisons.index') }}" class="btn-retour"><</a>

    <div class="entete-saison">
        <h1>{{ $saison->nom }}</h1>
        <p>Du {{ $saison->date_debut }} au {{ $saison->date_fin ? $saison->date_fin : 'En cours' }}</p>
        <span class="badge-statut {{ $saison->is_active ? 'badge-active' : 'badge-close' }}">
            {{ $saison->is_active ? 'En cours' : 'Clôturée' }}
        </span>
    </div>

    <h2 class="soustitre-liste" style="margin-top: 2rem;">Classement</h2>
    
    <ul class="classement-liste">
        @forelse($saison->joueurs as $joueur)
        <li class="joueur-carte">
            <div class="joueur-info">
                <div class="joueur-avatar" style="background-color: {{ $joueur->couleur }};">
                    <img src="{{ asset('avatars/' . $joueur->avatar . '.png') }}" alt="Avatar">
                </div>
                <div>
                    <p class="mot-principal">{{ $joueur->nom }}</p>
                    <a href="{{ route('joueurs.show', $joueur->id_joueur) }}" style="font-size: 0.8rem; color: var(--violet-moyen); text-decoration: none;">Voir le profil</a>
                </div>
            </div>
            <div class="joueur-score">{{ $joueur->pivot->score }} pts</div>
        </li>
        @empty
        <li class="liste-vide">Aucun joueur pour cette saison.</li>
        @endforelse
    </ul>

    <div style="display: flex; gap: 10px; justify-content: center; margin-top: 2rem;">
        <a href="{{ route('saisons.edit', $saison->id_saison) }}" class="btn-valider" style="background-color: var(--violet-clair); color: var(--violet-foncé);">Modifier</a>
    </div>
</div>

@endsection