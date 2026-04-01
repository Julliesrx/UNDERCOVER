@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/parties.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative;">
    <a href="{{ route('dashboard') }}" class="btn-retour">&lt;</a>

    <h2 class="titre-page-mots" style="text-align: center; margin-top: 20px;">LISTE DES PARTIES</h2>

    <div class="liste-container">
        @forelse($parties as $partie)
        <div class="carte-partie">
            <div class="partie-info">
                <p class="partie-titre">{{ $partie->mot->mot1 }} | {{ $partie->mot->mot2 }}</p>
                <p class="partie-statut">Gagnant : {{ $partie->role_gagnant ?? 'En cours' }}</p>
                <p style="font-size: 0.8rem; color: #888;">{{ $partie->created_at->format('d/m/Y') }}</p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('parties.show', $partie->id_partie) }}" class="btn-action-chic">Voir</a>
                @if(auth()->user()->role === 'admin')
                <form action="{{ route('parties.destroy', $partie->id_partie) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action-chic btn-suppr" onclick="return confirm('Supprimer ?')">Suppr</button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <p>Aucune partie pour l'instant.</p>
        @endforelse
    </div>
</div>
@endsection