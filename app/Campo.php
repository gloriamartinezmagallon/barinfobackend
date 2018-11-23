<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Campo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'nombre'
    ];

    

    public function subcampos()
    {
        return $this->hasMany('App\Subcampo');
    }
}
