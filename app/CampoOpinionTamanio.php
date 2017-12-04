<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoOpinionTamanio extends Model
{
    protected $fillable = [
        'campo_opinion_id', 'tamanio',
    ];
}
