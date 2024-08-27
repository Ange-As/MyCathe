<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catechumene extends Model
{
    use HasFactory;

    protected $table = "catechumene";

    protected $fillable = [
        'matricule',
        'photo',
        'nom',
        'prenom',
        'age_de_naissance',
        'contact',
        'niveau_catechese',
        'classe_or_profession',
        'jour_cours',
        'annee_catechese',
        'profil',
        'date_naissance',
        'date_inscription'
    ];
}
