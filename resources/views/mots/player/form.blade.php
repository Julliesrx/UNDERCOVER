@extends('template') 

@section('title', 'Personnaliser une paire de mots')

@section('content')
    
<div id="content">
    <a href="{{ route('mots.index') }}" class="btn-retour"><</a>

    <h2 class="soustitre-liste">{{ isset($mot) ? 'Modifier la paire' : 'Ajouter une paire' }}</h2>

    <form action="{{ isset($mot) ? route('mots.update', $mot->id_mots) : route('mots.store') }}" method="POST" class="form-chic">
        @csrf
        @if(isset($mot))
            @method('PUT')
        @endif

        <label>Mot 1</label>
        <input type="text" name="mot1" value="{{ old('mot1', $mot->mot1 ?? '') }}" placeholder="Ex: Parapluie">
        
        <label>Mot 2</label>
        <input type="text" name="mot2" value="{{ old('mot2', $mot->mot2 ?? '') }}" placeholder="Ex: Montgolfière">
        <!-- input hidden id -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        
        <button type="submit" class="btn-fonce">{{ isset($mot) ? 'Modifier' : 'Ajouter' }}</button>   
    </form>
</div>

@endsection