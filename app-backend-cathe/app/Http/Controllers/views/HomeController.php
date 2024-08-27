<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\Catechumene;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $first = Catechumene::where("annee_catechese", "1 ÈRE ANNÉE")->where("date_inscription", today())->count();
        $second = Catechumene::where("annee_catechese", "2 ÈME ANNÉE")->where("date_inscription", today())->count();
        $three = Catechumene::where("annee_catechese", "3 ÈME ANNÉE")->where("date_inscription", today())->count();
        $four = Catechumene::where("annee_catechese", "4 ÈME ANNÉE")->where("date_inscription", today())->count();
        $five = Catechumene::where("annee_catechese", "5 ÈME ANNÉE")->where("date_inscription", today())->count();

        // Passer les données à la vue
        return view('index', compact('first', 'second', 'three', 'four', 'five'));
    }

    public function catechumene()
    {
        return view('catechumene');
    }

    public function animateur()
    {
        return view('animateur');
    }

    public function countCatechumene()
    {
        $first = Catechumene::where("annee_catechese", "1 ÈRE ANNÉE")->where("date_inscription", today())->count();
        $second = Catechumene::where("annee_catechese", "2 ÈME ANNÉE")->where("date_inscription", today())->count();
        $three = Catechumene::where("annee_catechese", "3 ÈME ANNÉE")->where("date_inscription", today())->count();
        $four = Catechumene::where("annee_catechese", "4 ÈME ANNÉE")->where("date_inscription", today())->count();
        $five = Catechumene::where("annee_catechese", "5 ÈME ANNÉE")->where("date_inscription", today())->count();

        // Passer les données à la vue
        return view('count_catechumene', compact('first', 'second', 'three', 'four', 'five'));
    }
}
