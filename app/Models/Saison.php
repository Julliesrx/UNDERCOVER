<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    protected $primaryKey = 'id_saison';
    protected $fillable = ['nom', 'date_debut', 'date_fin', 'is_active'];

    public function joueurs() {
        return $this->belongsToMany(Joueur::class, 'saisons_joueurs', 'id_saison', 'id_joueur')
                    ->withPivot('score');
    }

    // Une saison a plusieurs parties
    public function parties() {
        return $this->hasMany(Partie::class, 'id_saison');
    }
}
