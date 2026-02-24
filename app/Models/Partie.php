<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    protected $fillable = ['date', 'nbJoueurs', 'nbUndercovers', 'nbMrWhite', 'mot_civil', 'mot_undercover', 'id_mots', 'id_user'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function mot() {
        return $this->belongsTo(Mot::class, 'id_mots');
    }

    public function joueurs() {
        return $this->belongsToMany(Joueur::class, 'x_parties', 'id_partie', 'id_joueur');
    }
}
