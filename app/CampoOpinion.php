<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoOpinion extends Model
{
    protected $fillable = [
        'bar_id', 'campo_id', 'tiene','deviceid', 'opinion_id'
    ];

    public function marcas()
    {
        return $this->hasMany('App\CampoOpinionMarca');
    }

    public function tamanios()
    {
        return $this->hasMany('App\CampoOpinionTamanio');
    }

    public function campo()
    {
        return $this->belongsTo('App\Campo');
    }

    public function opinion()
    {
        return $this->belongsTo('App\Opinion');
    }

    
}
