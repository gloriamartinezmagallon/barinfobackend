<?php

namespace App\Http\Controllers\App;

use App\Campo;
use App\Http\Controllers\Controller;
use App\Subcampo;
use Illuminate\Http\Request;

class AppCamposController extends Controller
{
    public function addCampo(Request $request){

        $nombre = $request->input('nombre');

        $campo = Campo::where(['nombre'=>$nombre])->first();

        if ($campo != null){
            return response()->json(['msg'=>'Ya existe un campo con ese nombre.'], 404);
        }

        $campo = new Campo();
        $campo->nombre = $nombre;
        $campo->save();

        return $campo;
    }

    public function addSubCampo(Request $request){

        $campo_id = $request->input('campo_id');
        $nombre = $request->input('nombre');


        $indicarvaloracion = $request->input('indicarvaloracion');
        $indicarnumero = $request->input('indicarnumero');
        $indicarprecio = $request->input('indicarprecio');
        $indicartamanio = $request->input('indicartamanio');
        $indicarmarca = $request->input('indicarmarca');
        $indicarubicacion = $request->input('indicarubicacion');

        $subcampo = Subcampo::where(['campo_id'=>$campo_id,'nombre'=>$nombre])->first();

        if ($subcampo == null){
            $subcampo = new Subcampo();
            $subcampo->campo_id = $campo_id;
            $subcampo->nombre = $nombre;
        }

        $subcampo->indicarvaloracion = $indicarvaloracion;
        $subcampo->indicarnumero = $indicarnumero;
        $subcampo->indicarprecio = $indicarprecio;
        $subcampo->indicartamanio = $indicartamanio;
        $subcampo->indicarmarca = $indicarmarca;
        $subcampo->indicarubicacion = $indicarubicacion;
        $subcampo->save();

        return $subcampo;


    }
}
