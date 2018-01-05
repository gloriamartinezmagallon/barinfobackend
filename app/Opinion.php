<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = [
        'bar_id', 'precio', 'calidad', 'texto','tipo_id','deviceid'
    ];


    public function tipo()
    {
        return $this->belongsTo('App\Tipo');
    }

    public function camposopiniones()
    {
        return $this->hasMany('App\CampoOpinion');
    }
}
