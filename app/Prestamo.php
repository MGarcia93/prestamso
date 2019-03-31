<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table='prestamos';

    public function cliente(){
        return  $this->hasMany('App\Cliente',"ID","IDCLIENTE");
    }
}
