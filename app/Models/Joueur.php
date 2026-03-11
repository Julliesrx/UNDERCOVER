<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    protected $primaryKey = 'id_joueur';
    protected $fillable = ['nom', 'avatar', 'scoreTotal', 'id_user'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function parties() {
        return $this->belongsToMany(Partie::class, 'x_parties', 'id_joueur', 'id_partie')
                    ->withPivot('role', 'mot_recu', 'score', 'estGagnant');
    }

    public function saisons() {
        return $this->belongsToMany(Saison::class, 'saison_joueur', 'id_joueur', 'id_saison')
                    ->withPivot('score');
    }
}
