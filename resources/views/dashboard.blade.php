@extends('template') 

@section('title', 'Nouvelle partie')

@section('content')
        
        <a href="{{ route('parties.create') }}">Play</a>

@endsection