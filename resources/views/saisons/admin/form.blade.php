@extends('dashboard') 

@section('title', 'Formulaire saison')

@section('content')

    @if(isset($saison))
        <form action="{{ route('saisons.update', $saison->id_saison) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('saisons.store') }}" method="POST">
        @csrf
    @endif

        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $saison->nom ?? '') }}">

        @if(isset($saison))
            <label>Date de début : {{ $saison->date_debut }}</label>
        @else
            <label>Date de début : Aujourd'hui</label>
        @endif

        <label>Date de fin</label>
        <input type="date" name="date_fin" value="{{ old('date_fin', $saison->date_fin ?? '') }}">

        <button type="submit">{{ isset($saison) ? 'Modifier' : 'Créer' }}</button>

    </form>

@endsection