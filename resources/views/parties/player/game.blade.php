<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
    <title>Undercover | Partie en cours</title>
</head>
<body>
    <div id="header">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 501.27 684.05"><defs><style>.cls-1,.cls-2{fill:#caa8c6;}.cls-1,.cls-5{stroke:#100111;stroke-miterlimit:10;stroke-width:24.85px;}.cls-3{clip-path:url(#clip-path);}.cls-4{fill:#100111;}.cls-5{fill:none;}</style><clipPath id="clip-path"><path class="cls-1" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/></clipPath></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-2" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/><g class="cls-3"><path class="cls-4" d="M434.09,617.33c-19.88-15.25-40.26-26-53.12-48.68-8.64-15.22-14.3-31.91-21.4-47.91-5.68-12.77-12.5-25.38-21.92-35.59a75.43,75.43,0,0,0-7.62-7.22c-13.54-11.09-32.53-16.81-49-10.91-15.06,5.4-26,20.59-26.48,36.58-.11,4,.43,8.12,2.5,11.52s5.91,5.94,9.88,5.57c7.39-.68,10.53-9.68,16.38-14.24,8.12-6.33,20.66-2.8,27.75,4.65s10.27,17.68,13.86,27.33c12.23,32.86,31.82,64.84,58.43,87.88,27.73,24,61.08,40.57,95.45,52.76l5.46,1.89c5.72-7.18,11.6-14.19,17-21.57A446.42,446.42,0,0,1,434.09,617.33Z"/><path class="cls-4" d="M487.11,344.29,395.26,155.18c-41.23-55.45-110-89.27-179.13-88q10.94,33.3,21.88,66.59c-24.91,9.56-44.16,32.59-49.16,58.8L108.67,181.3c7.66,31.07,15.44,62.46,30,90.95C199.16,390.27,382,400,487.11,344.29Z"/></g><path class="cls-5" d="M348,142.26A170.22,170.22,0,1,0,126.52,343.38l-.36,324.84,330.7-80.86-150.2-288A170.08,170.08,0,0,0,348,142.26Z"/></g></g></svg>
    </div>

    <div id="phase-decouverte">
        <div id="carousel-cartes">

        </div>
    </div>

    <div id="phase-jeu">

    </div>

    <div id="phase-fin">

    </div>

    <script>

        const partie = @json($partie);
        const joueurs = @json($partie->joueurs);
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
                    <div class="carte-face-avant">
                        <p>${joueur.nom}</p>
                        <img src="${joueur.avatar}" alt="${joueur.nom}">
                        <p>Clique pour voir ton mot</p>
                    </div>
                    <div class="carte-face-arriere">
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
        }

    </script>
</body>
</html>