<?php
namespace App\Utils;

use App\Bar;
use App\Campo;
use App\Tipo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class BuscadorBares
{

    var $conOpiniones = true;
    
    public function buscar($request)
    {
        
        $this->conOpiniones = $request->input('conOpiniones', false) ;
        $NombreLocalidad = $request->input('NombreLocalidad', '');
        $Tipo            = $request->input('Tipo', '');
        $Especialidad    = $request->input('Especialidad', '');
        $DescripZona     = $request->input('DescripZona', '');

        $Latitud  = $request->input('Latitud', 0);
        $Longitud = $request->input('Longitud', 0);

        $campos = $request->input('Campo', []);

        if (gettype($campos) == 'string'){
            $campos = json_decode($campos,true);
        }

        $whereArgs = ['1 = 1'];

        if ($this->conOpiniones == 'true'){
            $this->conOpiniones = true;
        }else if ($this->conOpiniones == 'false'){
            $this->conOpiniones = false;
        }

        if ($this->conOpiniones){
            $whereArgs[] = 'campo_opinions.bar_id IS NOT NULL';
        }

        if ($NombreLocalidad != '') {
            $whereArgs[] = 'nombreLocalidad = \'' . $NombreLocalidad . '\'';
        }

        if ($Tipo > 0) {
            $whereArgs[] = 'opinions.tipo_id = \'' . $Tipo . '\'';
        }

        if ($Especialidad != '') {
            $whereArgs[] = 'especialidad = \'' . $Especialidad . '\'';
        }

        if ($DescripZona != '') {
            $whereArgs[] = 'descripZona = \'' . $DescripZona . '\'';
        }

        if (is_array($campos)){
            foreach ($campos as $c) {
                if ($c['tiene'] != 0 || $c['tamanio'] != 0 || $c['marca'] != 0) {
                    $whereArgs[] = 'campo_opinions.campo_id = ' . $c['id'];
                    $whereArgs[] = 'campo_opinions.tiene = 1';
                    if ($c['tamanio'] != '') {
                        $whereArgs[] = 'campo_opinion_tamanios.tamanio = ' . $c['tamanio'];
                    }
                    if ($c['marca'] != '') {
                        $whereArgs[] = 'campo_opinion_marcas.nombre = \'' . $c['marca'] . '\'';
                    }
                }
            }
        }


        file_put_contents("filename.txt", json_encode($whereArgs));
        

        if ($Latitud != 0) {
            $distance = '(6371 *  2 * ASIN(SQRT(POWER(SIN((ORIGLAT- Latitud) * pi()/180 / 2), 2) +COS(ORIGLAT * pi()/180) *COS(Latitud * pi()/180) *POWER(SIN((ORIGLNG -Longitud) * pi()/180 / 2), 2) ))) as distance';

            $distance = str_replace('ORIGLAT', $request->input('Latitud', $Latitud), $distance);
            $distance = str_replace('ORIGLNG', $request->input('Longitud', $Longitud), $distance);

            $bares = DB::table('bars')
                ->leftjoin('opinions', 'opinions.bar_id', '=', 'bars.id')
                ->leftjoin('campo_opinions', 'campo_opinions.opinion_id', '=', 'opinions.id')
                ->leftjoin('campo_opinion_tamanios', 'campo_opinion_tamanios.campo_opinion_id', '=', 'campo_opinions.id')
                ->leftjoin('campo_opinion_marcas', 'campo_opinion_marcas.campo_opinion_id', '=', 'campo_opinions.id')
                ->select('bars.*', DB::raw($distance))
                ->whereRaw(implode(' AND ', $whereArgs))
                ->groupBy('bars.*')
                ->orderBy('distance', 'ASC')
                ->get();
        } else {
            $bares = DB::table('bars')
                ->leftjoin('campo_opinions', 'campo_opinions.bar_id', '=', 'bars.id')
                ->leftjoin('campo_opinion_tamanios', 'campo_opinion_tamanios.campo_opinion_id', '=', 'campo_opinions.id')
                ->leftjoin('campo_opinion_marcas', 'campo_opinion_marcas.campo_opinion_id', '=', 'campo_opinions.id')
                ->select('bars.*')
                ->whereRaw(implode(' AND ', $whereArgs))
                ->groupBy(['id','codrecursoGN', 'nombre', 'nombreLocalidad', 'tipo', 'especialidad', 'imgFicheroGN', 'descripZona', 'latitud', 'longitud','direccion','created_at','updated_at'])
                ->get();

            file_put_contents("prueba.txt", '////' . implode(' AND ', $whereArgs));
        }


        return $bares;
    }

    public function getLocalidades()
    {
        return $this->getDistinctColumn('NombreLocalidad');
    }

    public function getTipos()
    {
        return $this->getDistinctColumn('Tipo');
    }

    public function getEspecialidades()
    {
        return $this->getDistinctColumn('Especialidad');
    }

    public function getZonas()
    {
        return $this->getDistinctColumn('DescripZona');
    }

    public function getCampos()
    {
        $campos   = [];
        $camposdb = Campo::get();

        foreach ($camposdb as $c) {
            $aux = [
                'id'             => $c->id,
                'nombre'         => $c->nombre,
                'indicarmarca'   => $c->indicarmarca,
                'indicartamanio' => $c->indicartamanio,
                'numopiniones'   => count($c->opiniones),
                'marcas'         => ['' => Lang::get('app.buscador.indicarmarca')],
                'tamanios'       => ['' => Lang::get('app.buscador.indicartamanio')],
            ];
            foreach ($c->opiniones as $op) {
                foreach ($op->marcas as $m) {
                    if (!in_array($m->Nombre, $aux['marcas'])) {
                        $aux['marcas'][$m->Nombre] = $m->Nombre;
                    }
                }

                foreach ($op->tamanios as $m) {
                    if (!in_array($m->tamanio, $aux['tamanios'])) {
                        $aux['tamanios'][$m->tamanio] = $m->tamanio;
                    }
                }
            }
            if ($aux['numopiniones'] > 0) {
                $campos[] = $aux;
            }

        }
        usort($campos, function ($a, $b) {return $b['numopiniones'] - $a['numopiniones'];});
        return $campos;
    }

    public function getLocalidadesApp()
    {
        return $this->getDistinctColumnApp('NombreLocalidad');
    }

    public function getTiposApp()
    {
        return $this->getDistinctColumnApp('Tipo');
    }

    public function getEspecialidadesApp()
    {
        return $this->getDistinctColumnApp('Especialidad');
    }

    public function getZonasApp()
    {
        return $this->getDistinctColumnApp('DescripZona');
    }

    public function getCamposApp()
    {
        $campos   = [];
        $camposdb = Campo::get();

        foreach ($camposdb as $c) {
            $aux = [
                'id'             => $c->id,
                'nombre'         => $c->nombre,
                'indicarmarca'   => $c->indicarmarca,
                'indicartamanio' => $c->indicartamanio,
                'numopiniones'   => count($c->opiniones),
                'marcas'         => [],
                'tamanios'       => [],
            ];
            foreach ($c->opiniones as $op) {
                foreach ($op->marcas as $m) {
                    if (!in_array($m->Nombre, $aux['marcas'])) {
                        $aux['marcas'][] = $m->nombre;
                    }
                }

                foreach ($op->tamanios as $m) {
                    if (!in_array($m->tamanio, $aux['tamanios'])) {
                        $aux['tamanios'][] = $m->tamanio;
                    }
                }
            }
            //if ($aux['numopiniones'] > 0) {
            $campos[] = $aux;
            // }

        }
        usort($campos, function ($a, $b) {return $b['numopiniones'] - $a['numopiniones'];});
        return $campos;
    }

    public function getDistinctColumn($column)
    {
        $aux        = Bar::select($column)->whereRaw($column . '!= \'\'')->distinct()->orderBy($column)->get();
        $resultados = ['' => ''];

        foreach ($aux as $a) {
            $resultados[$a->{$column}] = $a->{$column};
        }

        return $resultados;
    }

    public function getDistinctColumnApp($column)
    {
        $aux        = Bar::select($column)->whereRaw($column . '!= \'\'')->distinct()->orderBy($column)->get();
        $resultados = [''];

        foreach ($aux as $a) {
            $resultados[] = $a->{$column};
        }

        return $resultados;
    }

    public function getParams()
    {
        return [
            'localidades'    => $this->getLocalidadesApp(),
            'tiposgn'          => $this->getTiposApp(),
            'especialidades' => $this->getEspecialidadesApp(),
            'zonas'          => $this->getZonasApp(),

            'campos'         => $this->getCamposApp(),
            'tipos'         => Tipo::get(),
        ];
    }

}
