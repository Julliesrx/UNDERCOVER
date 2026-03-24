@extends('administration') 

@section('title', 'Liste des users')

@section('content')

    <h1>Liste des users</h1>
    <a href="{{ route('users.create') }}">Ajouter un user</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul>
        @forelse($users as $user)
        <li>
            <div class="list-left">
                <p>Nom : {{ $user->nom }}</p>
                <p>Username : {{ $user->username }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Compte {{ $user->is_banned ? 'banni' : 'actif' }}</p>
            </div>
            <div class="list-right">
                <div class="icons">
                    <a href="{{ route('users.show', $user->id_user) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 861.1 545.19"><defs><style>.cls-1{fill:#100111;}</style></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1" d="M850.58,243.48C791.38,173.19,625.69,0,430.55,0S69.72,173.19,10.52,243.48a45.53,45.53,0,0,0,0,58.22c59.2,70.29,224.89,243.49,420,243.49S791.38,372,850.58,301.7A45.55,45.55,0,0,0,850.58,243.48Zm-420,211.1a182,182,0,1,1,182-182A182,182,0,0,1,430.55,454.58Z"/><path class="cls-1" d="M430.55,185.58a87,87,0,1,0,87,87A87,87,0,0,0,430.55,185.58Z"/></g></g></svg></a>
                    <a href="{{ route('users.edit', $user->id_user) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 663.78 663.8"><defs><style>.cls-1{fill:#100111;}</style></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1" d="M644.4,65.21,598.56,19.38a66.34,66.34,0,0,0-93.72,0l-301.5,301.5a66.38,66.38,0,0,0-17.15,29.7l-29.9,111.59a37.05,37.05,0,0,0,35.57,46.61,37.67,37.67,0,0,0,9.75-1.3l111.58-29.9a66.23,66.23,0,0,0,29.71-17.15l301.5-301.5A66.34,66.34,0,0,0,644.4,65.21Zm-104.49,136-44,44-78.25,78.26L311.79,429.32a22.32,22.32,0,0,1-10,5.76l-99.87,26.76L228.69,362a22.3,22.3,0,0,1,5.77-10L340.34,246.11l78.22-78.23,66.56-66.56,77.33,77.33Zm73.37-73.37-19.71,19.72L516.24,70.21,536,50.49a22.31,22.31,0,0,1,31.5,0l45.83,45.83A22.29,22.29,0,0,1,613.28,127.82Z"/><path class="cls-1" d="M520.85,584.61a35.2,35.2,0,0,1-35.2,35.19H79.19A35.18,35.18,0,0,1,44,584.62V178.14a35.2,35.2,0,0,1,35.2-35.2H318.34a22,22,0,0,0,22-22h0a22,22,0,0,0-22-22H65.4A65.4,65.4,0,0,0,0,164.34V598.39A65.4,65.4,0,0,0,65.41,663.8h434a65.41,65.41,0,0,0,65.41-65.41V345.45a22,22,0,0,0-22-22h0a22,22,0,0,0-22,22Z"/></g></g></svg></a>
                </div>
                <form action="{{ route('users.ban', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">{{ $user->is_banned ? 'Débannir' : 'Bannir' }}</button>
                </form>
                <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </li>
        @empty
        <li>Aucun user pour l'instant</li>
        @endforelse
    </ul>

@endsection