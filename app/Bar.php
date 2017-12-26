<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'codrecursoGN', 'nombre', 'nombreLocalidad', 'tipo', 'especialidad', 'imgFicheroGN', 'descripZona', 'latitud', 'longitud','direccion'
    ];

    public function opiniones()
    {
        return $this->hasMany('App\Opinion');
    }
}
