@extends('template') 

@section('title', 'Nouvelle partie')

@section('content')

    <div id="content" class="dashboard-content">
        
        <a href="{{ route('parties.create') }}" class="btn-play">Play</a>

        @if($saison)
            <a href="{{ route('saisons.show', $saison->id_saison) }}" class="section-saison-cadre">
                <span class="titre-saison">Saison en cours : {{ $saison->nom }}</span>
                <span class="date-saison">Depuis le : {{ $saison->date_debut }}</span>
            </a>
        @else
            <p class="saison-vide">Aucune saison n'est en cours.</p>
        @endif

    </div>

@endsection