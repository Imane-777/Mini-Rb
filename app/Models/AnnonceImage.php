<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnonceImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'path',
        'position',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
