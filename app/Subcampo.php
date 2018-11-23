<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Subcampo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'nombre'
    ];

    public function campo()
    {
        return $this->belongsTo('App\Campo');
    }


    public function subcampoOpiniones()
    {
        return $this->hashMany('App\SubcampoOpinion');
    }
}
