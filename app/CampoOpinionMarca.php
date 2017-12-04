<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoOpinionMarca extends Model
{
    protected $fillable = [
        'campo_opinion_id', 'nombre',
    ];
}
