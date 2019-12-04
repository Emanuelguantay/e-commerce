<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_talles extends Model
{
    public function talle () {
    	//un detalle pertenece a un producto determinado
        return $this->belongsTo(Talle::class);
    }

    public function product(){
    	return $this->belongsTo(Product::class)->select('id','name');
    }
}
