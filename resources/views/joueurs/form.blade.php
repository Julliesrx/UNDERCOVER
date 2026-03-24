@extends('dashboard') 

@section('title', 'Personnalisation d\'un joueur')

@section('content')
    
    @if(isset($joueur))
        <form action="{{ route('joueurs.update', $joueur->id_joueur) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('joueurs.store') }}" method="POST">
        @csrf
    @endif
            <input type="text" name="nom" value="{{ old('nom', $joueur->nom ?? '') }}">
            <input type="text" name="avatar" value="{{ old('avatar', $joueur->avatar ?? '') }}">
            <!-- input hidden avec l'id du compte et rectifier dans bdd peut pas etre null -->
            <button type="submit">{{ isset($joueur) ? 'Modifier' : 'Ajouter' }}</button>   
        </form>

@endsection