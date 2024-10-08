<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModePaiement extends Model
{
    use HasFactory;

    protected $table = "mode_paiement";

    protected $fillable = [
        "photo",
        "nom_mode",
        "contact",
        "is_active"
    ];
}
