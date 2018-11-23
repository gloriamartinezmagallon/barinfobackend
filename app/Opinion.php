<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Opinion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'bar_id', 'precio', 'calidad', 'texto','tipo_id','deviceid'
    ];


    public function tipo()
    {
        return $this->belongsTo('App\Tipo');
    }

    public function subcamposopiniones()
    {
        return $this->hasMany('App\SubcampoOpinion');
    }
}
