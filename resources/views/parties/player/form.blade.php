@extends('template')

@section('title', 'Nouvelle partie')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/jeu.css') }}">
@endpush

@section('content')
<div id="content" style="position: relative; padding-top: 20px;">
    <a href="{{ route('dashboard') }}" class="btn-retour">&lt;</a>

    <h2 style="text-align: center; font-family: var(--titre); color: var(--violet-foncé); margin-bottom: 25px;">CRÉER UNE PARTIE</h2>

    <form action="{{ route('parties.store') }}" method="POST" class="config-container">
        @csrf

        <div class="slider-group">
            <label>Nombre de joueurs : <span id="nbJoueurs_val">3</span></label>
            <input type="range" id="nbJoueurs" name="nbJoueurs" min="3" max="15" value="3" oninput="suggestionBaguette(this.value)">
        </div>

        <div class="ligne-compteur">
            <label style="margin: 0; font-family: var(--titre);">Undercovers</label>
            <div class="controles-btn">
                <button type="button" onclick="modifier('nbUndercovers', -1)">-</button>
                <span id="nbUndercovers_val">1</span>
                <input type="hidden" id="nbUndercovers" name="nbUndercovers" value="1">
                <button type="button" onclick="modifier('nbUndercovers', 1)">+</button>
            </div>
        </div>

        <div class="ligne-compteur">
            <label style="margin: 0; font-family: var(--titre);">Mr White</label>
            <div class="controles-btn">
                <button type="button" onclick="modifier('nbMrWhite', -1)">-</button>
                <span id="nbMrWhite_val">0</span>
                <input type="hidden" id="nbMrWhite" name="nbMrWhite" value="0">
                <button type="button" onclick="modifier('nbMrWhite', 1)">+</button>
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="font-family: var(--titre); color: var(--violet-foncé); display: block; margin-bottom: 8px;">Dictionnaire</label>
            <select name="option_mots" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid var(--violet-clair);">
                <option value="base">Standard</option>
                <option value="perso">Personnalisés</option>
                <option value="mix">Mélange</option>
            </select>
        </div>

        <h3 style="font-family: var(--titre); color: var(--violet-foncé); font-size: 1.1rem; margin-bottom: 15px;">SÉLECTION JOUEURS</h3>
        <div class="grille-joueurs-simple" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 30px;">
            @foreach($joueurs as $joueur)
            <label class="case-joueur" style="display: flex; flex-direction: column; align-items: center; background: white; padding: 10px; border-radius: 15px; border: 2px solid var(--violet-clair); cursor: pointer;">
                <div style="background-color: {{ $joueur->couleur }}; width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 2px solid white;">
                    <img src="{{ asset('avatars/profil/' . $joueur->avatar . '.png') }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span style="font-size: 0.75rem; font-weight: bold; margin-top: 5px;">{{ $joueur->nom }}</span>
                <input type="checkbox" name="joueurs[]" value="{{ $joueur->id_joueur }}">
            </label>
            @endforeach
        </div>

        <button type="submit" class="btn-lancer">COMMENCER LA PARTIE</button>
    </form>
</div>

<script>

    const tableIdeale = {
        3:{u:1,w:0}, 4:{u:1,w:1}, 5:{u:2,w:1}, 6:{u:2,w:1}, 7:{u:2,w:1},
        8:{u:3,w:1}, 9:{u:4,w:1}, 10:{u:4,w:1}, 11:{u:5,w:1}, 12:{u:5,w:1},
        13:{u:6,w:1}, 14:{u:6,w:1}, 15:{u:7,w:1}
    };

    function suggestionBaguette(val) {
        document.getElementById('nbJoueurs_val').textContent = val;
        const suggestion = tableIdeale[val];
        if (suggestion) {
            // On force les valeurs suggérées dans les inputs
            document.getElementById('nbUndercovers').value = suggestion.u;
            document.getElementById('nbMrWhite').value = suggestion.w;
            // On met à jour l'affichage des spans
            document.getElementById('nbUndercovers_val').textContent = suggestion.u;
            document.getElementById('nbMrWhite_val').textContent = suggestion.w;
        }
        updateLimites(); 
    }


    function modifier(champ, delta) {
        const input = document.getElementById(champ);
        const span = document.getElementById(champ + '_val');
        let valeur = parseInt(input.value) + delta;
        
        input.value = valeur;
        span.textContent = valeur;
        updateLimites();
    }

    // Fonction de Didi pour gérer les limites et les checkboxes
    function updateLimites() {
        const nbJoueurs = parseInt(document.getElementById('nbJoueurs').value);
        let u = parseInt(document.getElementById('nbUndercovers').value);
        let w = parseInt(document.getElementById('nbMrWhite').value);

        const maxIntrus = Math.floor(nbJoueurs / 2); // Règle 1 : Max 50% d'intrus
        let maxW = Math.floor(u / 2); // Règle 2 : Max 50% de Mr White / Undercover

        if (w > maxW) w = maxW;
        if (u + w > maxIntrus) {
            while (u + w > maxIntrus && w > 0) w--;
            while (u + w > maxIntrus && u > 1) u--;
        }
        if (u < 1) u = 1;
        if (w < 0) w = 0;

        // Mise à jour finale
        document.getElementById('nbUndercovers').value = u;
        document.getElementById('nbUndercovers_val').textContent = u;
        document.getElementById('nbMrWhite').value = w;
        document.getElementById('nbMrWhite_val').textContent = w;

        // Gestion des checkboxes 
        const cochees = document.querySelectorAll('input[name="joueurs[]"]:checked').length;
        document.querySelectorAll('input[name="joueurs[]"]').forEach(cb => {
            if (!cb.checked) {
                cb.disabled = (cochees >= nbJoueurs);
            }
        });
    }

    // Listener sur les checkboxes
    document.querySelectorAll('input[name="joueurs[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateLimites);
    });

    // On lance une fois au chargement
    updateLimites();
</script>
@endsection