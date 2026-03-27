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
            <!-- <input type="text" name="avatar" value="{{ old('avatar', $joueur->avatar ?? '') }}"> -->

            <div id="selecteur-avatar">
                <button type="button" onclick="avatarPrecedent()">←</button>
                
                <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                    <img id="avatar-img" src="" alt="avatar" style="width: 90px;">
                </div>
                
                <button type="button" onclick="avatarSuivant()">→</button>
            </div>
            <input type="hidden" name="avatar" id="avatar-choisi" value="{{ old('avatar', $joueur->avatar ?? '') }}">

            <div id="selecteur-couleurs">
                @foreach($couleurs as $couleur)
                    <div 
                        class="couleur-option {{ isset($joueur) && $joueur->couleur == $couleur ? 'selected' : '' }}"
                        style="background-color: {{ $couleur }}"
                        onclick="choisirCouleur('{{ $couleur }}', this)"
                    ></div>
                @endforeach
            </div>
            <input type="hidden" name="couleur" id="couleur-choisie" value="{{ old('couleur', $joueur->couleur ?? '') }}">

            <!-- input hidden avec l'id du compte et rectifier dans bdd peut pas etre null -->
            <button type="submit">{{ isset($joueur) ? 'Modifier' : 'Ajouter' }}</button>   
        </form>

        <script>
            const avatars = @json($avatars);
            let avatarIndex = 0;

            // Si mode edit, on commence sur l'avatar actuel
            @if(isset($joueur) && $joueur->avatar)
                avatarIndex = avatars.indexOf('{{ $joueur->avatar }}');
            @endif

            function updateAvatar() {
                const img = document.getElementById('avatar-img');
                img.src = `/avatars/${avatars[avatarIndex]}.png`;
                document.getElementById('avatar-choisi').value = avatars[avatarIndex];
            }

            function avatarSuivant() {
                avatarIndex = (avatarIndex + 1) % avatars.length;
                updateAvatar();
            }

            function avatarPrecedent() {
                avatarIndex = (avatarIndex - 1 + avatars.length) % avatars.length;
                updateAvatar();
            }

            function choisirCouleur(couleur, element) {
                document.getElementById('couleur-choisie').value = couleur;
                document.getElementById('avatar-display').style.backgroundColor = couleur;
                
                document.querySelectorAll('.couleur-option').forEach(div => {
                    div.classList.remove('selected');
                });
                element.classList.add('selected');
            }

            function initCouleur() {
            const premiere = document.querySelector('.couleur-option');
            if(premiere && !document.getElementById('couleur-choisie').value) {
                const couleur = premiere.style.backgroundColor;
                document.getElementById('couleur-choisie').value = '{{ $couleurs[0] }}';
                document.getElementById('avatar-display').style.backgroundColor = couleur;
                premiere.classList.add('selected');
            }
        }

        updateAvatar();
        initCouleur();

            // Si mode edit, mettre la couleur actuelle
            @if(isset($joueur) && $joueur->couleur)
                document.getElementById('avatar-display').style.backgroundColor = '{{ $joueur->couleur }}';
            @endif
        </script>

@endsection