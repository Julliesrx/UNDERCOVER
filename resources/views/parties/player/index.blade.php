@extends('template') 

@section('title', 'Historique des parties')

@section('content')

    <a href="{{ route('dashboard') }}"><</a>

    <h1>Liste des parties</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($parties as $partie)
        <li>
            <p>{{ $partie->mot->mot1 }} | {{ $partie->mot->mot2 }}</p>
            <p>Gagnant : {{ $partie->role_gagnant ?? 'Partie en cours' }}</p>
            <p>{{ $partie->created_at->format('d/m/Y') }}</p>
            <div>
                <a href="{{ route('parties.show', $partie->id_partie) }}">Voir</a>
            </div>
        </li>
        @empty
        <li>Aucune partie pour l'instant</li>
        @endforelse
    </ul>

@endsection