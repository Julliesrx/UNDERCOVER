@extends('template') 

@section('title', 'Saison en cours')

@section('content')

<div id="content">
    <a href="{{ route('dashboard') }}" class="btn-retour"><</a>

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
                </div>
            </div>
            <div class="joueur-score">{{ $joueur->pivot->score }} pts</div>
        </li>
        @empty
        <li class="liste-vide">Aucun joueur pour cette saison.</li>
        @endforelse
    </ul>
</div>

@endsection