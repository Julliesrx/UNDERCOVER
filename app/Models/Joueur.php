<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    protected $fillable = ['nom', 'avatar', 'scoreTotal', 'id_user'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function parties() {
        return $this->belongsToMany(Partie::class, 'x_parties', 'id_joueur', 'id_partie');
    }
}
