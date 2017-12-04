<?php

namespace App\Http\Controllers\App;

use App\Bar;
use App\Http\Controllers\Controller;
use App\Utils\BuscadorBares;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function bares(Request $request)
    {
        $buscador = new BuscadorBares();
        $bares    = $buscador->buscar($request);
        return $bares;
    }

    public function buscadorinit()
    {
        $buscador = new BuscadorBares();

        return $buscador->getParams();
    }

    public function barinfo($id)
    {
        return Bar::find($id);
    }
}
