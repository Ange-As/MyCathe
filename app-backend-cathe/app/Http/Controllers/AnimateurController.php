<?php

namespace App\Http\Controllers;

use App\Models\Animateur;
use Illuminate\Http\Request;

class AnimateurController extends Controller
{
    //

    private function validateRequestData(Request $request)
    {
        return $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "contact" => "required",
            "categorie_catechumene" => "required",
            "jour_cours" => "required",
            "annee_catechese" => "required"
        ]);
    }

    public function store(Request $request)
    {
        $credentials = $this->validateRequestData($request);

        $create = Animateur::create($credentials);

        if (!$create) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }

        return response()->json(["message" => "Animateur enregistré avec succès !", "status" => 200]);
    }
}
