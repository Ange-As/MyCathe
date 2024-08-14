<?php

namespace App\Http\Controllers;

use App\Models\ModePaiement;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    //
    private function validateRequestDataPaiement(Request $request)
    {
        return $request->validate([
            "catechumene_id" => "required",
            "mode_paiement" => "required",
            "reference_id" => "required",
        ]);
    }

    private function validateRequestDataModePaiement(Request $request)
    {
        return $request->validate([
            "photo" => "reuqired",
            "nom_mode" => "reuqired",
            "contact" => "reuqired",
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateRequestDataPaiement($request);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('cvs', 'public');
            $data['photo'] = $photo;
        }

        $data["is_active"] = true;


        $create = ModePaiement::create($data);

        if (!$create) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }

        return response()->json(["message" => "Mode de paiement ajouté avec succès !", "status" => 200]);
    }


    public function storeReferences(Request $request)
    {
        $data = $this->validateRequestDataPaiement($request);

        $create = Paiement::create($data);

        if (!$create) {
            return response()->json(["message" => "Une erreur est survenue !", "status" => 500]);
        }

        return response()->json(["message" => "Mode de paiement ajouté avec succès !", "status" => 200]);
    }


    public function indexModePaiement()
    {
        $modes = ModePaiement::all();
        return response()->json($modes);
    }

    public function indexPaiement($is_valid)
    {
        $paiements = Paiement::where('is_paiement_valid', $is_valid)->paginate(10);
        return response()->json($paiements);
    }
}
