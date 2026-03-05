<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'adresse',
        'ville',
        'prix_par_nuit',
        'image',
        'nombre_de_chambres'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
