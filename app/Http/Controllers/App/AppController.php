<?php

namespace App\Http\Controllers\App;

use App\Bar;
use App\CampoOpinion;
use App\CampoOpinionMarca;
use App\CampoOpinionTamanio;
use App\Http\Controllers\Controller;
use App\Opinion;
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
        return  Bar::with('opiniones')->with('opiniones.tipo')->with('opiniones.camposopiniones')->with('opiniones.camposopiniones.campo')->with('opiniones.camposopiniones.marcas')->with('opiniones.camposopiniones.tamanios')->find($id);
    }

    public function addopinion(Request $request){
        file_put_contents("prueba.txt", $request->getContent());
        $data = json_decode($request->getContent());

        if ($data->id > 0){
            $opinion = Opinion::find($data->id);
            $deviceid = $data->device_id;
            $barid = $data->bar_id;

            $campoopiniones = CampoOpinion::where(['opinion_id'=>$data->id])->get();
            foreach($campoopiniones as $co){
                foreach($co->marcas as $m){
                    $m->delete();
                }
                foreach($co->tamanios as $m){
                    $m->delete();
                }
                $co->delete();
            }

        }else{
            $opinion = new Opinion();
        }
        
        $opinion->bar_id = $data->bar_id;
        $opinion->calidad = $data->calidad;
        $opinion->deviceid = $data->device_id;
        if ($data->tipo_id > 0){
             $opinion->tipo_id = $data->tipo_id;
        }

        $opinion->save();
        if (isset($data->campos)){
            foreach($data->campos as $campo){
                $campoopinion = new CampoOpinion();
                $campoopinion->bar_id = $opinion->bar_id;
                $campoopinion->opinion_id = $opinion->id;
                $campoopinion->deviceid = $opinion->deviceid;
                $campoopinion->campo_id = $campo->campo_id;
                $campoopinion->tiene = $campo->tiene;
                $campoopinion->save();
                if (isset($campo->marcas)){
                    foreach($campo->marcas as $m){
                        $campoopinionmarca = new CampoOpinionMarca();
                        $campoopinionmarca->campo_opinion_id = $campoopinion->id;
                        $campoopinionmarca->nombre = $m->nombre;
                        $campoopinionmarca->save();
                    }
                }
                
                if (isset($campo->tamanios)){
                    foreach($campo->tamanios as $t){
                        $campoopiniontamanio = new CampoOpinionTamanio();
                        $campoopiniontamanio->campo_opinion_id = $campoopinion->id;
                        switch ($t->tamanio) {
                            case 'Pequeño':
                                $t = 1;
                                break;
                            case 'Normal':
                                $t = 2;
                                break;
                            case 'Grande':
                                $t = 3;
                                break;
                            default:
                                # code...
                                break;
                        }

                        $campoopiniontamanio->tamanio = $t;
                        $campoopiniontamanio->save();
                    }
                }
            }
        }

        return Bar::with('opiniones')->with('opiniones.tipo')->with('opiniones.camposopiniones')->with('opiniones.camposopiniones.campo')->with('opiniones.camposopiniones.marcas')->with('opiniones.camposopiniones.tamanios')->find($opinion->bar_id);
    }
}
