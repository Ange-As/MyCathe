<?php

namespace App\Http\Controllers;

use App\Imports\CatechumenesImport;
use App\Models\Catechumene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class CatechumeneController extends Controller
{
    //

    private function validateRequestData(Request $request)
    {
        return $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "age_de_naissance" => "required",
            "contact" => "required",
            "niveau_catechese" => "required",
            "classe_or_profession" => "required",
            "jour_cours" => "required",
            "annee_catechese" => "required",
            "profil" => "required",
            "date_naissance" => "required"
        ]);
    }


    public function store(Request $request)
    {
        try {
            Log::info('Store method called');

            $data = $this->validateRequestData($request);
            Log::info('Validated data: ', $data);

            $data["date_inscription"] = today();

            $name_substr = substr($data["nom"], 0, 3);
            $replace = str_replace('-', '', $data["date_naissance"]);
            $data["matricule"] = $name_substr . $replace;

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->store('cvs', 'public');
                Log::info('Photo path: ' . $photo);
                $data['photo'] = $photo;
            }

            $create = Catechumene::create($data);
            Log::info('Catechumene created: ', $create->toArray());

            if (!$create) {
                return response()->json(["message" => "Une erreur est survenue lors de la création", "status" => 500]);
            }

            return response()->json(["message" => "Catéchumène ajouté avec succès !", "status" => 200, "id_cate" => $create->id]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout du catéchumène: " . $e->getMessage());
            return response()->json(["message" => "Une erreur est survenue: " . $e->getMessage(), "status" => 500]);
        }
    }


    public function getOne($matricule)
    {
        $is_exist = Catechumene::where('matricule', $matricule)->first();

        if ($is_exist) {
            return response()->json($is_exist);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $import = new CatechumenesImport();
        Excel::import($import, $request->file('file'));

        // Les données importées sont maintenant dans $import->rows
        $importedData = $import->rows;

        // Option 1: Les afficher directement (par exemple, dans un tableau)
        foreach ($importedData as $row) {
            print_r($row);
        }

        // Option 2: Retourner les données dans une réponse JSON
        return response()->json(['message' => 'Importation réussie', 'data' => $importedData], 200);
    }
}
