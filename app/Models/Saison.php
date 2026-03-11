<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    protected $fillable = ['nom', 'date_debut', 'date_fin', 'is_active'];

    public function joueurs() {
        return $this->belongsToMany(Joueur::class, 'saison_joueur', 'id_saison', 'id_joueur')
                    ->withPivot('score');
    }

    // Une saison a plusieurs parties
    public function parties() {
        return $this->hasMany(Partie::class, 'id_saison');
    }
}
