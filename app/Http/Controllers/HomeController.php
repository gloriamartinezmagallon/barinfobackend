<?php

namespace App\Http\Controllers;

use App\Bar;
use App\Utils\BuscadorBares;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {

        $buscador = new BuscadorBares($request);
        return view('home', [
            'bares'    => Bar::get(),
            'buscador' => $buscador,
            'busqueda' => true,
        ]);
    }

    public function buscar(Request $request)
    {

        $buscador = new BuscadorBares();

        $bares = $buscador->buscar($request);
        return view('home', [
            'bares'    => $bares,
            'buscador' => $buscador,
            'busqueda' => true,
        ]);
    }
}
