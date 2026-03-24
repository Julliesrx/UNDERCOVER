@extends('home') 

@section('title', 'Personnaliser une paire de mots')

@section('content')
    
    @if(isset($mot))
        <form action="{{ route('mots.update', $mot->id_mots) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('mots.store') }}" method="POST">
        @csrf
    @endif
            <input type="text" name="mot1" value="{{ old('mot1', $mot->mot1 ?? '') }}">
            <input type="text" name="mot2" value="{{ old('mot2', $mot->mot2 ?? '') }}">
            <!-- input hidden avec l'id du compte et rectifier dans bdd peut pas etre null -->
            <button type="submit">{{ isset($mot) ? 'Modifier' : 'Ajouter' }}</button>   
        </form>

@endsection