<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animateur extends Model
{
    use HasFactory;

    protected $table = "animateur";

    protected $fillable = [
        "photo_animateur",
        "nom",
        "prenom",
        "contact",
        "categorie_catechumene",
        "jour_cours",
        "annee_catechese"

    ];
}
