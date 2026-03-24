@extends('dashboard') 

@section('title', 'Banque de mots')

@section('content')

    <h1>Liste des paires de mots</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <a href="{{ route('mots.create') }}">Ajouter une paire de mots</a>

    <ul>
        @forelse($mots as $mot)
        <li>
            <p>{{ $mot->mot1 }} | {{ $mot->mot2 }}</p>
            <div>
                <form action="{{ route('mots.destroy', $mot->id_mots) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>
            Aucune paire de mots pour l'instant
        </li>
        @endforelse
    </ul>

@endsection