<?php

namespace App\Http\Controllers;

use App\Services\PaiementServices;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    //

    protected $paiementService;

    public function __construct(PaiementServices $paiementServices)
    {
        $this->paiementService = $paiementServices;
    }


    public function saveModePaiement(Request $request)
    {
        return $this->paiementService->store($request);
    }

    public function savePaiement(Request $request)
    {
        return $this->paiementService->storeReferences($request);
    }

    public function getAllModePaiement(){
        return $this->paiementService->indexModePaiement();
    }

    public function getAllPaiement(Request $request){
        $status = $request->input('status') ?? false;
        return $this->paiementService->indexPaiement($status); 
    }
}
