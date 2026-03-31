@extends('administration') 

@section('title', 'Liste des saisons')

@section('content')

<div id="content">
    <h2 class="soustitre-liste">Gestion des Saisons</h2>

    @if(session('success'))
        <p class="alerte-succes">{{ session('success') }}</p>
    @endif

    @if(!$saisonActive)
        <div style="text-align: center; margin-bottom: 2rem;">
            <a href="{{ route('saisons.create') }}" class="btn-valider">Créer une saison</a>
        </div>
    @else
        <p style="text-align: center; color: var(--violet-moyen); font-style: italic; margin-bottom: 2rem;">Une saison est en cours. Clôturez-la avant d'en ouvrir une nouvelle.</p>
    @endif

    <ul class="liste-mots">
        @forelse($saisons as $saison)
        <li class="ligne-mot" style="flex-direction: column; align-items: flex-start; gap: 10px;">
            <div style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p class="mot-principal">{{ $saison->nom }}</p>
                    <p style="font-size: 0.85rem; color: var(--violet-moyen);">
                        {{$saison->date_debut }} - {{ $saison->date_fin ? $saison->date_fin : '...' }}
                    </p>
                </div>
                <span class="badge-statut {{ $saison->is_active ? 'badge-active' : 'badge-close' }}" style="margin: 0;">
                    {{ $saison->is_active ? 'En cours' : 'Clôturée' }}
                </span>
            </div>
            
            <div class="actions-mot" style="width: 100%; justify-content: flex-end; margin-top: 10px; border-top: 1px dashed var(--violet-clair); padding-top: 10px;">
                <a href="{{ route('saisons.show', $saison->id_saison) }}" class="btn-action" title="Voir">👁️</a>
                <a href="{{ route('saisons.edit', $saison->id_saison) }}" class="btn-action" title="Modifier">✏️</a>
                
                @if($saison->is_active)
                <form action="{{ route('saisons.cloturer', $saison->id_saison) }}" method="POST" class="form-suppression">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-action" title="Clôturer" onclick="return confirm('Sûr de vouloir clôturer ?')">🛑</button>
                </form>
                @endif

                <form action="{{ route('saisons.destroy', $saison->id_saison) }}" method="POST" class="form-suppression">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action" title="Supprimer" onclick="return confirm('Supprimer cette saison ?')">🗑️</button>
                </form>
            </div>
        </li>
        @empty
        <li class="liste-vide">Aucune saison pour l'instant</li>
        @endforelse
    </ul>
</div>

@endsection