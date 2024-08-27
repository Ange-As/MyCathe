<?php

use App\Http\Controllers\views\HomeController;
use App\Http\Controllers\views\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('home');
Route::get('/catechumene', [HomeController::class, "catechumene"])->name('catechumene');
Route::get('/animateur', [HomeController::class, 'animateur'])->name('animateur');
Route::get('/connexion', [LoginController::class, 'login'])->name('login');


Route::post('/send-info-connexion', [LoginController::class, 'user_login'])->name('user_login');
Route::get('/deconnexion', [LoginController::class, 'logout'])->name('logout');
