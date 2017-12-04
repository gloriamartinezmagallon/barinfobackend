<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    protected $fillable = [
        'nombre', 'indicarmarca', 'indicartamanio',
    ];

    public function opiniones()
    {
        return $this->hasMany('App\CampoOpinion');
    }
}
