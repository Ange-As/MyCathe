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

    public function editAnimateur(Request $request, $id)
    {
        $credentials = $this->validateRequestData($request);

        $is_exist = Animateur::findOrFail($id);

        $update = $is_exist->update($credentials);

        if (!$update) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }

        return response()->json(["message" => "Mise à jour effectuée avec succès !", "status" => 200]);
    }

    public function deleteAnimateur($id)
    {
        $is_exist = Animateur::findOrFail($id);

        $delete = $is_exist->delete();

        if (!$delete) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }
        return response()->json(["message" => "Mise à jour effectuée avec succès !", "status" => 200]);
    }


    public function searchAnimateur(Request $request)
    {
        $annee_catechese = $request->input('annee_catechese');
        $categorie = $request->input('categorie');
        $jour_cours = $request->input('jour_cours');

        $query = Animateur::query();

        if ($annee_catechese) {
            $query->where('annee_catechese', 'LIKE', '%' . $annee_catechese . '%');
        }

        if ($categorie) {
            $query->where('categorie_catechumene', 'LIKE', '%' . $categorie . '%');
        }

        if ($jour_cours) {
            $query->where("jour_cours", 'LIKE', '%' . $jour_cours . '%');
        }

        $data = $query->get();

        return response()->json($data);
    }
}
