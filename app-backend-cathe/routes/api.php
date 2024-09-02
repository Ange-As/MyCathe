<?php

use App\Http\Controllers\AnimateurController;
use App\Http\Controllers\CatechumeneController;
use App\Http\Controllers\PaiementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/v1/catechumene/store', [CatechumeneController::class, 'store']);
Route::post('/v1/animateur/store', [AnimateurController::class, 'store']);
Route::post('/v1/mode-paiement/store', [PaiementController::class, 'saveModePaiement']);
Route::post('/v1/paiement/store', [PaiementController::class, 'storeReferences']);

Route::get("/v1/mode-paiement/index", [PaiementController::class, 'getAllModePaiement']);
Route::get("/v1/paiement/index", [PaiementController::class, 'getAllPaiement']);
Route::get('/v1/catechumene/{matricule}/get', [CatechumeneController::class, 'getOne']);

Route::get('/v1/paiement/{id_user}/get', [PaiementController::class, 'getOnePaiement']);
Route::get('/v1/animateur/filter', [AnimateurController::class, 'searchAnimateur']);
Route::put('/v1/catechumene/{matricule}/edit', [CatechumeneController::class, 'editCatechumene']);
Route::put('/v1/animateur/{id}/edit', [AnimateurController::class, 'editAnimateur']);

Route::delete('/v1/animateur/{id}/delete', [AnimateurController::class, 'deleteAnimateur']);
