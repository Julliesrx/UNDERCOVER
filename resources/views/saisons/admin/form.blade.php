@extends('administration') 

@section('title', 'Formulaire saison')

@section('content')

<div id="content">
    <a href="{{ route('saisons.index') }}" class="btn-retour"><</a>

    <h2 class="soustitre-liste">{{ isset($saison) ? 'Modifier la saison' : 'Nouvelle saison' }}</h2>

    @if(isset($saison))
        <form action="{{ route('saisons.update', $saison->id_saison) }}" method="POST" class="form-chic">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('saisons.store') }}" method="POST" class="form-chic">
        @csrf
    @endif

        <label>Nom de la saison</label>
        <input type="text" name="nom" value="{{ old('nom', $saison->nom ?? '') }}" placeholder="Ex: Saison des Diamants">

        @if(isset($saison))
            <p style="color: var(--violet-moyen); font-size: 0.9rem;">Date de début : {{ $saison->date_debut }}</p>
        @else
            <p style="color: var(--violet-moyen); font-size: 0.9rem;">Date de début : Aujourd'hui</p>
        @endif

        <label>Date de fin (Optionnel)</label>
        <input type="date" name="date_fin" value="{{ old('date_fin', $saison->date_fin ?? '') }}">

        <button type="submit" class="btn-valider">{{ isset($saison) ? 'Modifier' : 'Créer la saison' }}</button>
    </form>
</div>

@endsection