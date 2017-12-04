<?php

namespace App\Http\Controllers\Admin;

use App\Bar;
use App\Http\Controllers\Controller;
use App\Utils\gPoint;
use Goutte\Client;
use Illuminate\Http\Request;

class SincroController extends Controller
{

    const URL_GN = 'http://www.navarra.es/appsext/DescargarFichero/default.aspx?codigoAcceso=Opendata&fichero=Turismo\Resultados_DC_es.json';

    const URL_IMG_GN = 'http://www.turismo.navarra.es/imgs/rrtt/';

    public function showSincroFrom()
    {
        return view('admin.sincro.form', ['resultsincro' => false]);
    }

    public function sincro(Request $request)
    {
        ini_set('max_execution_time', '3000000');
        $client = new Client();

        $crawler = $client->request('GET', self::URL_GN);

        $datos = json_decode(str_replace('\\', '/', str_replace("\r\n", "", $client->getResponse()->getContent())), true);

        $gPoint      = new gPoint();
        $creados     = 0;
        $modificados = 0;
        foreach ($datos['OpenData']['OpenDataRow'] as $d) {

            $gPoint->setUTM(floatval($d['GEORR_X']), floatval($d['GEORR_Y']), '30V');
            $gPoint->convertTMtoLL();
            $db = [
                'codrecursoGN'    => $d['Codrecurso'],
                'nombre'          => $d['Nombre'],
                'nombreLocalidad' => $d['NombreLocalidad'],
                'tipo'            => $d['Tipo'],
                'especialidad'    => $d['Especialidad'],
                'imgFicheroGN'    => ($d['ImgFichero'] != '' ? self::URL_IMG_GN . $d['Path'] . $d['ImgFichero'] : null),
                'descripZona'     => $d['DescripZona'],
                'latitud'         => $gPoint->Lat(),
                'longitud'        => $gPoint->Long(),
            ];

            try{

                $url = 'http://maps.google.com/maps/api/geocode/json?latlng='.$db['latitud'].','.$db['longitud'].'&sensor=false?project=760876073544';
                
                $json = file_get_contents($url);
                $obj = json_decode($json);

                    dd($obj);
                if ($obj->status !== 'OK'){
                    $db['direccion'] = str_replace(', Spain', '',$obj->results[0]->formatted_address);
                }
            }catch(\Exception $e){}
                
            

            $affectedRows = Bar::where(['codrecursoGN' => $db['codrecursoGN']])->update($db);
            if ($affectedRows == 0) {
                $creados++;
                Bar::insert($db);
            } else {
                $modificados++;
            }
        }

        return view('admin.sincro.form', ['creados' => $creados, 'modificados' => $modificados, 'resultsincro' => true]);

    }
}
