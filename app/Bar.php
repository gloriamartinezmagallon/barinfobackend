<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bar extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'codrecursoGN', 'nombre', 'nombreLocalidad', 'tipo', 'especialidad', 'imgFicheroGN', 'descripZona', 'latitud', 'longitud','direccion','deviceid'
    ];

    public function opiniones()
    {
        return $this->hasMany('App\Opinion');
    }
}
