@extends('template') 

@section('title', 'Nouvelle partie')

@section('content')
        
        <a href="{{ route('parties.create') }}">Play</a>

            @if($saison)
                <a href="{{ route('saisons.show', $saison->id_saison) }}">
                    <p>Saison en cours : {{ $saison->nom }}</p>
                    <p>Depuis le : {{ $saison->date_debut }}</p>
                </a>
            @else
                <p>Aucune saison en cours</p>
            @endif
        </div>

@endsection