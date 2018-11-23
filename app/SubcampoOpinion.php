<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SubcampoOpinion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public function subcampo()
    {
        return $this->belongsTo('App\Subcampo');
    }


    public function subcampoOpiniones()
    {
        return $this->hashMany('App\SubcampoOpinion');
    }
}
