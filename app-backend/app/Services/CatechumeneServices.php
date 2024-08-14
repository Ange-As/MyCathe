<?php

namespace App\Services;

use App\Models\Catechumene;
use Illuminate\Http\Request;

class CatechumeneServices
{

    private function validateRequestData(Request $request)
    {
        return $request->validate([
            "photo" => "required",
            "nom" => "required",
            "prenom" => "required",
            "age_de_naissance" => "required",
            "contact" => "required",
            "niveau_catechese" => "required",
            "classe_or_profession" => "required",
            "jour_cours" => "required",
            "date_inscription" => "required",
            "annee_catechese" => "required"
        ]);
    }


    public function store(Request $request)
    {

        $data = $this->validateRequestData($request);

        
        $name_substr = substr($data["nom"], 0, 3);
        $replace = str_replace('-', '', $data["date_naissance"]);
        $data["matricule"] = $name_substr . $replace;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('cvs', 'public');
            $data['photo'] = $photo;
        }

        $create = Catechumene::create($data);

        if (!$create) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }

        return response()->json(["message" => "Catéchumène ajouté avec succès !", "status" => 200]);
    }


    public function getOne($matricule)
    {
        $is_exist = Catechumene::where('matricule', $matricule)->first();

        if ($is_exist) {
            return response()->json($is_exist);
        }
    }
}
