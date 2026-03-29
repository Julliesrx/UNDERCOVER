<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('undercover-favicon.png') }}">
    <link rel="stylesheet" href="https://use.typekit.net/jib5pzl.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
    <title>Undercover | Partie en cours</title>
</head>
<body>
    <div id="header">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 501.27 684.05"><defs><style>.cls-1,.cls-2{fill:#caa8c6;}.cls-1,.cls-5{stroke:#100111;stroke-miterlimit:10;stroke-width:24.85px;}.cls-3{clip-path:url(#clip-path);}.cls-4{fill:#100111;}.cls-5{fill:none;}</style><clipPath id="clip-path"><path class="cls-1" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/></clipPath></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-2" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/><g class="cls-3"><path class="cls-4" d="M434.09,617.33c-19.88-15.25-40.26-26-53.12-48.68-8.64-15.22-14.3-31.91-21.4-47.91-5.68-12.77-12.5-25.38-21.92-35.59a75.43,75.43,0,0,0-7.62-7.22c-13.54-11.09-32.53-16.81-49-10.91-15.06,5.4-26,20.59-26.48,36.58-.11,4,.43,8.12,2.5,11.52s5.91,5.94,9.88,5.57c7.39-.68,10.53-9.68,16.38-14.24,8.12-6.33,20.66-2.8,27.75,4.65s10.27,17.68,13.86,27.33c12.23,32.86,31.82,64.84,58.43,87.88,27.73,24,61.08,40.57,95.45,52.76l5.46,1.89c5.72-7.18,11.6-14.19,17-21.57A446.42,446.42,0,0,1,434.09,617.33Z"/><path class="cls-4" d="M487.11,344.29,395.26,155.18c-41.23-55.45-110-89.27-179.13-88q10.94,33.3,21.88,66.59c-24.91,9.56-44.16,32.59-49.16,58.8L108.67,181.3c7.66,31.07,15.44,62.46,30,90.95C199.16,390.27,382,400,487.11,344.29Z"/></g><path class="cls-5" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/></g></g></svg>
        <form action="{{ route('parties.quitter', $partie->id_partie) }}" method="POST" id="form-quitter">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Quitter et supprimer la partie ?')">✕ Quitter</button>
        </form>
    </div>

    <section>
        <div id="phase-decouverte">
            <div id="carousel-cartes">

            </div>
        </div>

        <div id="phase-jeu" style="display: none;">
            <div id="liste-joueurs">
                <!-- Les joueurs actifs s'affichent ici, générés en JS -->
            </div>

            <div id="popup-elimination" style="display:none">
                <div id="popup-contenu">
                    <!-- Contenu de la popup selon le rôle éliminé -->
                </div>
            </div>
        </div>

        <div id="phase-fin">

        </div>
    </section>

    <script>

        const partie = @json($partie);
        const joueurs = @json($partie->joueurs);
        const dashboardUrl = "{{ route('dashboard') }}";
        
        // CARTES MOTS
        
        let carteActuelle = 0;

        creerCartes();
        positionnerCartes();

        function creerCartes() {
            const carousel = document.getElementById("carousel-cartes");

            joueurs.forEach((joueur, index) => {
                const carte = document.createElement("div");
                carte.classList.add("carte");
                carte.id = `carte-${index}`;

                carte.innerHTML = `
                <div class="carte-inner">
                    <div class="carte-face-avant" style="background-color: ${joueur.couleur};">
                        <p>${joueur.nom}</p>
                        <div id="avatar-display" style="border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                            <img src="/avatars/carte/${joueur.avatar}.png" alt="" style="width: 120px;">
                        </div>  
                        <p>Clique pour voir ton mot</p>
                    </div>
                    <div class="carte-face-arriere" style="background-color: ${joueur.couleur};">
                        <p>${joueur.pivot.mot_recu ?? 'Mr White'}</p>
                    </div>
                </div>
                <button onclick="event.stopPropagation(); carteVue(${index})">J'ai lu !</button>
                `;

                carousel.appendChild(carte);

                carte.addEventListener('click', function() {
                    if(!this.classList.contains('retournee')) {
                        this.classList.add('retournee');
                    } else {
                        this.classList.remove('retournee');
                    }
                });
            });
        }

        function positionnerCartes() {
            joueurs.forEach((joueur, index) => {
                const carte = document.getElementById(`carte-${index}`);
                const diff = index - carteActuelle;
                
                if(diff === 0) {
                    // Carte actuelle → au centre, grande
                    carte.style.transform = 'translateX(0) scale(1) rotateY(0deg)';
                    // carte.style.opacity = '1';
                    carte.style.zIndex = '3';
                    carte.style.pointerEvents = 'auto';
                } else if(diff === 1) {
                    // Carte suivante → droite, bien espacée
                    carte.style.transform = 'translateX(120%) scale(0.8) rotateY(30deg)';
                    carte.style.opacity = '1';
                    carte.style.zIndex = '2';
                    carte.style.pointerEvents = 'none'; // pas cliquable
                } else if(diff === -1) {
                    // Carte précédente → gauche, bien espacée
                    carte.style.transform = 'translateX(-120%) scale(0.8) rotateY(-30deg)';
                    carte.style.opacity = '1';
                    carte.style.zIndex = '2';
                    carte.style.pointerEvents = 'none'; // pas cliquable
                } else if(diff < -1) {
                    // Cartes lointaines passées → cachées à GAUCHE
                    carte.style.transform = 'translateX(-120%) scale(0.7)';
                    carte.style.opacity = '0';
                    carte.style.zIndex = '1';
                    carte.style.pointerEvents = 'none';
                } else {
                    // Cartes lointaines à venir → cachées à DROITE
                    carte.style.transform = 'translateX(120%) scale(0.7)';
                    carte.style.opacity = '0';
                    carte.style.zIndex = '1';
                    carte.style.pointerEvents = 'none';
                }
            });
        }

        function carteVue(index) {
            
            // Retourner la carte face cachée
            const carte = document.getElementById(`carte-${index}`);
            carte.classList.remove('retournee');

            setTimeout(()=>{
                carteActuelle++;
        
                if(carteActuelle >= joueurs.length) {
                    // Tous les joueurs ont vu leur mot → passer à la phase jeu
                    setTimeout(() => {
                        passerPhaseJeu();
                    }, 800);
                } else {
                    positionnerCartes();
                }
            }, 600);
        }

        function passerPhaseJeu() {
            document.getElementById('phase-decouverte').style.display = 'none';
            document.getElementById('phase-jeu').style.display = 'block';
            afficherPhaseJeu();
        }

        // PHASE DE JEU

        let joueursActifs = [...joueurs];

        function afficherPhaseJeu() {
            const liste = document.getElementById("liste-joueurs");
            liste.innerHTML = "";

            joueursActifs.forEach(joueur => {
                const div = document.createElement("div");
                div.classList.add("joueur-actif");
                div.id = `joueur-${joueur.id_joueur}`;

                div.innerHTML = `
                    <div class="avatar-joueur" style="background-color: ${joueur.couleur}; width: 120px;">
                        <img src="/avatars/profil/${joueur.avatar}.png" alt="${joueur.nom}" style="width: 120px;">
                    </div>
                    <p>${joueur.nom}</p>
                    <button onclick="confirmerElimination(${joueur.id_joueur})">Éliminer</button>
                `;

                liste.appendChild(div);
            });
        }

        function confirmerElimination(idJoueur) {
            const joueur = joueursActifs.find(j => j.id_joueur === idJoueur);

            const popup = document.getElementById("popup-elimination");
            const contenu = document.getElementById("popup-contenu");

            contenu.innerHTML = `
                <p>Voulez-vous vraiment éliminer <strong>${joueur.nom}</strong> ?</p>
                <button onclick="eliminerJoueur(${idJoueur})">Confirmer</button>
                <button onclick="fermerPopup()">Annuler</button>
            `;

            popup.style.display = "block";
        }

        function fermerPopup() {
            document.getElementById("popup-elimination").style.display = "none";
        }

        function eliminerJoueur(idJoueur) {
            const joueur = joueursActifs.find(j => j.id_joueur === idJoueur);
            fermerPopup();

            // Révéler le rôle
            const popup = document.getElementById('popup-elimination');
            const contenu = document.getElementById('popup-contenu');

            if(joueur.pivot.role === 'mrwhite') {
                // Mr White peut tenter de deviner le mot civil
                contenu.innerHTML = `
                    <p>${joueur.nom} était <strong>Mr White</strong> !</p>
                    <p>Il peut tenter de deviner le mot des civils :</p>
                    <input type="text" id="tentative-mrwhite" placeholder="Ton mot...">
                    <button onclick="verifierMrWhite(${idJoueur})">Valider</button>
                `;
                popup.style.display = 'block';
            } else {
                // Civil ou undercover → on révèle et on vérifie les conditions
                contenu.innerHTML = `
                    <p>${joueur.nom} était <strong>${joueur.pivot.role}</strong> !</p>
                    <button onclick="continuerApresElimination(${idJoueur})">Continuer</button>
                `;
                popup.style.display = 'block';

                // Retirer le joueur des actifs
                joueursActifs = joueursActifs.filter(j => j.id_joueur !== idJoueur);
            }
        }

        function verifierMrWhite(idJoueur) {
            const tentative = document.getElementById('tentative-mrwhite').value.toLowerCase().trim();
            const motCivil = partie.mot_civil.toLowerCase().trim();
            
            const contenu = document.getElementById('popup-contenu');
            const popup = document.getElementById('popup-elimination');

            // Retirer Mr White des actifs
            joueursActifs = joueursActifs.filter(j => j.id_joueur !== idJoueur);

            if(tentative === motCivil) {
                // Mr White a trouvé → il gagne !
                popup.style.display = 'none';
                terminerPartie('mrwhite');
            } else {
                // Mauvaise réponse → on continue
                contenu.innerHTML = `
                    <p>Mauvaise réponse ! Le jeu continue...</p>
                    <button onclick="continuerApresElimination(${idJoueur})">Continuer</button>
                `;
            }
        }

        function continuerApresElimination(idJoueur) {
            fermerPopup();
            
            // Vérifier les conditions de victoire
            const nbUndercoversActifs = joueursActifs.filter(j => j.pivot.role === 'undercover').length;
            const nbCivilsActifs = joueursActifs.filter(j => j.pivot.role === 'civil').length;
            const nbMrWhiteActifs = joueursActifs.filter(j => j.pivot.role === 'mrwhite').length;
            const nbJoueursActifs = joueursActifs.length;

            if(nbUndercoversActifs === 0 && nbMrWhiteActifs === 0) {
                // Plus d'undercovers ni de mr white → civils gagnent
                terminerPartie('civil');
            } else if(nbUndercoversActifs >= nbCivilsActifs) {
                // Autant ou plus d'undercovers que de civils → undercovers gagnent
                terminerPartie('undercover');
            } else {
                // On continue
                afficherPhaseJeu();
            }
        }

        function terminerPartie(roleGagnant) {
            // Sauvegarder le résultat en BDD via une requête fetch
            fetch(`/parties/${partie.id_partie}/terminer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    role_gagnant: roleGagnant,
                    joueurs: joueurs.map(j => ({
                        id_joueur: j.id_joueur,
                        score: calculerScore(j, roleGagnant),
                        estGagnant: j.pivot.role === roleGagnant
                    }))
                })
            })
            .then(response => response.json())
            .then(data => {
                joueurs.forEach(j => {
                    j.pivot.score = calculerScore(j, roleGagnant);
                    j.pivot.estGagnant = j.pivot.role === roleGagnant;
                });

                // Passer à la phase fin
                document.getElementById('phase-jeu').style.display = 'none';
                document.getElementById('phase-fin').style.display = 'block';
                afficherPhaseFin(roleGagnant);
            });
        }

        function calculerScore(joueur, roleGagnant) {
            if(joueur.pivot.role === roleGagnant) {
                return 10; // gagnant → 10 points
            }
            return 0; // perdant → 0 points
        }

        function afficherPhaseFin(roleGagnant) {
            const phaseFin = document.getElementById('phase-fin');
            
            // Texte selon le rôle gagnant
            const messages = {
                'civil': 'Les civils ont gagné !',
                'undercover': 'Les undercovers ont gagné !',
                'mrwhite': 'Mr White a gagné !'
            };

            // Trier les joueurs par score décroissant
            const joueursTriés = [...joueurs].sort((a, b) => b.pivot.score - a.pivot.score);

            phaseFin.innerHTML = `
                <h2>${messages[roleGagnant]}</h2>

                <div id="recap-mots">
                    <p>Mot des civils : <strong>${partie.mot_civil}</strong></p>
                    <p>Mot des undercover : <strong>${partie.mot_undercover}</strong></p>
                </div>

                <h3>Classement</h3>
                <ul id="classement">
                    ${joueursTriés.map((joueur, index) => `
                        <li>
                            <div class="avatar-joueur" style="background-color: ${joueur.couleur}">
                                <img src="/avatars/profil/${joueur.avatar}.png" alt="${joueur.nom}">
                            </div>
                            <p>${index + 1}. ${joueur.nom}</p>
                            <p>Rôle : ${joueur.pivot.role}</p>
                            <p>Score : ${joueur.pivot.score} pts</p>
                        </li>
                    `).join('')}
                </ul>

                <a href="${dashboardUrl}">Retour à l'accueil</a>
            `;
        }

    </script>
</body>
</html>