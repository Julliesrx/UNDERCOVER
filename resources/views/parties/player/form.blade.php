<<<<<<< HEAD
@extends('dashboard')
=======
@extends('template') 
>>>>>>> cf1f2ef0b65bc9feed24dfc9ccd0a9343af746ce

@section('title', 'Nouvelle partie')

@section('content')

<<<<<<< HEAD
<h1>Créer une partie</h1>
=======
    <a href="{{ route('dashboard') }}"><</a>

    <h1>Créer une partie</h1>
>>>>>>> cf1f2ef0b65bc9feed24dfc9ccd0a9343af746ce

<form action="{{ route('parties.store') }}" method="POST">
    @csrf

<<<<<<< HEAD
    <label>Nombre de joueurs : <span id="nbJoueurs_val">3</span></label>
    <input type="range" name="nbJoueurs" min="3" max="15" value="3" oninput="document.getElementById('nbJoueurs_val').textContent = this.value">

    <label>Nombre d'undercovers</label>
    <input type="number" name="nbUndercovers" min="1" max="3" value="{{ old('nbUndercovers') }}">

    <label>Nombre de Mr White</label>
    <input type="number" name="nbMrWhite" min="0" max="1" value="{{ old('nbMrWhite') }}">
=======
        <label>Nombre de joueurs : <span id="nbJoueurs_val">3</span></label>
        <input type="range" id="nbJoueurs" name="nbJoueurs" min="3" max="15" value="3" oninput="document.getElementById('nbJoueurs_val').textContent = this.value; updateLimites()">
        
        <label>Nombre d'undercovers : </label>
        <div>
            <button type="button" onclick="modifier('nbUndercovers', -1)">-</button>
            <span id="nbUndercovers_val">1</span>
            <input type="hidden" id="nbUndercovers" name="nbUndercovers" value="1">
            <button type="button" onclick="modifier('nbUndercovers', 1)">+</button>
        </div>

        <label>Nombre de Mr White : </label>
        <div>
            <button type="button" onclick="modifier('nbMrWhite', -1)">-</button>
            <span id="nbMrWhite_val">0</span>
            <input type="hidden" id="nbMrWhite" name="nbMrWhite" value="0">
            <button type="button" onclick="modifier('nbMrWhite', 1)">+</button>
        </div>
>>>>>>> cf1f2ef0b65bc9feed24dfc9ccd0a9343af746ce

    <label>Option mots</label>
    <select name="option_mots">
        <option value="base">Mots de base</option>
        <option value="perso">Mots personnalisés</option>
        <option value="mix">Mix</option>
    </select>

<<<<<<< HEAD
    <label>Joueurs</label>
    @foreach($joueurs as $joueur)
    <div>
        <input type="checkbox" name="joueurs[]" value="{{ $joueur->id_joueur }}">
        <label>{{ $joueur->nom }}</label>
    </div>
    @endforeach
=======
        <label>Joueurs</label>
        @foreach($joueurs as $joueur)
            <div>
                <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background-color: {{ $joueur->couleur }}; overflow: hidden">
                    <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" alt="" style="width: 120px;">
                </div>                
                <input type="checkbox" name="joueurs[]" value="{{ $joueur->id_joueur }}">
                <label>{{ $joueur->nom }}</label>
            </div>
        @endforeach
>>>>>>> cf1f2ef0b65bc9feed24dfc9ccd0a9343af746ce

    <button type="submit">Créer la partie</button>
</form>

    <script>

        updateLimites();

        function modifier(champ, delta) {
            const input = document.getElementById(champ);
            const span = document.getElementById(champ + '_val');
            
            let valeur = parseInt(input.value) + delta;
            const min = parseInt(input.min) || 0;
            const max = parseInt(input.max);
            
            // Respecter les limites
            valeur = Math.max(min, Math.min(max, valeur));
            
            input.value = valeur;
            span.textContent = valeur;
            
            updateLimites();
        }

        function updateLimites() {
            const nbJoueurs = parseInt(document.getElementById('nbJoueurs').value);
            
            const maxUndercovers = Math.floor(nbJoueurs / 3);
            document.getElementById('nbUndercovers').max = maxUndercovers;
            document.getElementById('nbUndercovers').min = 1;
            
            const nbUndercovers = parseInt(document.getElementById('nbUndercovers').value);
            if(nbUndercovers > maxUndercovers) {
                document.getElementById('nbUndercovers').value = maxUndercovers;
                document.getElementById('nbUndercovers_val').textContent = maxUndercovers;
            }

            const maxMrWhite = nbUndercovers / 2;
            document.getElementById('nbMrWhite').max = maxMrWhite;
            document.getElementById('nbMrWhite').min = 0;

            const nbMrWhite = parseInt(document.getElementById('nbMrWhite').value);
            if(nbMrWhite > maxMrWhite) {
                document.getElementById('nbMrWhite').value = maxMrWhite;
                document.getElementById('nbMrWhite_val').textContent = maxMrWhite;
            }
        }

        document.querySelectorAll('input[name="joueurs[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const nbJoueurs = parseInt(document.getElementById('nbJoueurs').value);
                const cochees = document.querySelectorAll('input[name="joueurs[]"]:checked').length;
                
                // Désactiver les cases non cochées si on a atteint le max
                document.querySelectorAll('input[name="joueurs[]"]').forEach(cb => {
                    if(!cb.checked) {
                        cb.disabled = cochees >= nbJoueurs;
                    }
                });
            });
        });

    </script>

@endsection