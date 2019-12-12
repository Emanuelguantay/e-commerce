<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;

class VendedorController extends Controller
{
    public function products(){
    	$products = Product::with('marca','indumentaria','genero','reviews')
    		->paginate(12);
        return view('vendedores.products',compact('products'));
    }
}
