<?php

namespace App\Services;

use App\Models\ModePaiement;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementServices
{


    private function validateRequestDataPaiement(Request $request)
    {
        return $request->validate([
            "catechumene_id",
            "mode_paiement_id",
            "reference_id",
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
        $data = $this->validateRequestDataModePaiement($request);

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

    public function indexPaiement($is_valid){
        $paiements = Paiement::where('is_paiement_valid', $is_valid)->paginate(10);
        return response()->json($paiements);
    }
}
