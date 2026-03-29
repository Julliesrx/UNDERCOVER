@extends('administration') 

@section('title', 'Liste des saisons')

@section('content')

    <h1>Liste des saisons</h1>
    @if(!$saisonActive)
        <a href="{{ route('saisons.create') }}">Créer une saison</a>
    @else
        <p>Une saison est déjà en cours — clôturez-la avant d'en créer une nouvelle.</p>
    @endif

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($saisons as $saison)
        <li>
            <p>{{ $saison->nom }}</p>
            <p>Début : {{ $saison->date_debut }}</p>
            <p>Fin : {{ $saison->date_fin ?? 'En cours' }}</p>
            <p>{{ $saison->is_active ? '🟢 Active' : '🔴 Clôturée' }}</p>
            <div>
                <a href="{{ route('saisons.show', $saison->id_saison) }}">Voir</a>
                <a href="{{ route('saisons.edit', $saison->id_saison) }}">Modifier</a>
                @if($saison->is_active)
                <form action="{{ route('saisons.cloturer', $saison->id_saison) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Clôturer</button>
                </form>
                @endif
                <form action="{{ route('saisons.destroy', $saison->id_saison) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>Aucune saison pour l'instant</li>
        @endforelse
    </ul>

@endsection