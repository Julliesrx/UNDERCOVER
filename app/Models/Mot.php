<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mot extends Model
{
    protected $fillable = ['mot1', 'mot2', 'id_user'];
    
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function parties() {
        return $this->hasMany(Partie::class, 'id_mots');
    }
}
