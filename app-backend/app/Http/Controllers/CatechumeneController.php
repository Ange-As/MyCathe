<?php

namespace App\Http\Controllers;

use App\Services\CatechumeneServices;
use Illuminate\Http\Request;

class CatechumeneController extends Controller
{
    //

    protected $catechumeneService;

    public function __construct(CatechumeneServices $catechumeneServices)
    {
        $this->catechumeneService = $catechumeneServices;
    }


    public function storeCatechumene(Request $request) {
        return $this->catechumeneService->store($request);
    }
}
