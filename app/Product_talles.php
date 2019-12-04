<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_talles extends Model
{
    public function talle () {
    	//un detalle pertenece a un producto determinado
        return $this->belongsTo(Talle::class);
    }
}
