<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = "paiement";

    protected $fillable = [
        "catechumene_id",
        "mode_paiement",
        "reference_id",
        "is_paiement_valid",
        "montant",
        "type_paiement"
    ];

    public function catechumene(){
        return $this->belongsTo(Catechumene::class, 'catechumene_id');
    }

    public function mode_paiement(){
        return $this->belongsTo(ModePaiement::class, 'mode_paiement_id');
    }
}
