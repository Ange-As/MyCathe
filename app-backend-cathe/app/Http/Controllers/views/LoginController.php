<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    // code pour se connecter
    public function user_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('successMessage', 'Vous êtes connecté, bienvenu(e) !');;
        } else {
            return back()->with('errorMessage', 'Mot de passe ou email incorrect');
        }
    }

    // code pour se deceonnecter
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
