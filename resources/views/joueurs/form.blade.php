@extends('template') 

@section('title', 'Personnalisation d\'un joueur')

@section('content')
    
<div id="content">
    <a href="{{ route('joueurs.index') }}" class="btn-retour"><</a>

    <h2 class="titre-page-mots">{{ isset($joueur) ? 'Modifier le joueur' : 'Ajouter un joueur' }}</h2>

    <form action="{{ isset($joueur) ? route('joueurs.update', $joueur->id_joueur) : route('joueurs.store') }}" method="POST">
        @csrf
        @if(isset($joueur))
            @method('PUT')
        @endif

        <label style="font-family: var(--corps); font-weight: 600; color: var(--violet-foncé); margin-bottom: 5px; display: block;">Nom du joueur</label>
        <input type="text" name="nom" value="{{ old('nom', $joueur->nom ?? '') }}" style="width: 100%; padding: 12px 15px; border: 2px solid var(--rose); border-radius: 15px; background-color: #fafafa; font-family: var(--corps); outline: none;">

        <div class="selecteur-avatar-conteneur">
            <button type="button" class="fleche-selecteur" onclick="avatarPrecedent()">←</button>
            
            <div id="avatar-display" class="avatar-form-display">
                <img id="avatar-img" src="" alt="avatar" style="width: 100px; object-fit: contain;">
            </div>
            
            <button type="button" class="fleche-selecteur" onclick="avatarSuivant()">→</button>
        </div>
        <input type="hidden" name="avatar" id="avatar-choisi" value="{{ old('avatar', $joueur->avatar ?? '') }}">

        <div class="liste-couleurs-form">
            @foreach($couleurs as $couleur)
                <div class="couleur-pastille {{ isset($joueur) && $joueur->couleur == $couleur ? 'selected' : '' }}"
                    style="background-color: {{ $couleur }}"
                    onclick="choisirCouleur('{{ $couleur }}', this)">
                </div>
            @endforeach
        </div>
        <input type="hidden" name="couleur" id="couleur-choisie" value="{{ old('couleur', $joueur->couleur ?? '') }}">

        <button type="submit">{{ isset($joueur) ? 'Modifier' : 'Ajouter' }}</button>   
    </form>
</div>

<script>
    const avatars = @json($avatars);
    let avatarIndex = 0;

    @if(isset($joueur) && $joueur->avatar)
        avatarIndex = avatars.indexOf('{{ $joueur->avatar }}');
    @endif

    function updateAvatar() {
        const img = document.getElementById('avatar-img');
        img.src = `/avatars/profil/${avatars[avatarIndex]}.png`;
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
        
        document.querySelectorAll('.liste-couleurs-form .couleur-pastille').forEach(div => {
            div.classList.remove('selected');
        });
        element.classList.add('selected');
    }

    function initCouleur() {
        const premiere = document.querySelector('.liste-couleurs-form .couleur-pastille');
        if(premiere && !document.getElementById('couleur-choisie').value) {
            const couleur = premiere.style.backgroundColor;
            document.getElementById('couleur-choisie').value = '{{ $couleurs[0] ?? "#CAA8C6" }}';
            document.getElementById('avatar-display').style.backgroundColor = couleur;
            premiere.classList.add('selected');
        }
    }

    updateAvatar();
    initCouleur();

    @if(isset($joueur) && $joueur->couleur)
        document.getElementById('avatar-display').style.backgroundColor = '{{ $joueur->couleur }}';
    @endif
</script>

@endsection