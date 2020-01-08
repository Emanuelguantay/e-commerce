<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;

class VendedorController extends Controller
{
	/*
	public function products(){
    	$products = Product::with('marca','indumentaria','genero','reviews')
    		->paginate(12);
        return view('vendedores.products',compact('products'));
    }*/
    public function products(Request $request){
    	$products = Product::with('marca','indumentaria','genero','reviews')
    		->paginate(12);
        return view('vendedores.products',compact('products'));
    }

    public function productlist(Request $request){
    	$genero_id = $request->input('genero_id');
        $marca_id = $request->input('marca_id');
        $indumentaria_id = $request->input('indumentaria_id');
        switch (true) {
            case ($genero_id != "null" && $marca_id != "null" && $indumentaria_id != "null"):
                $products = Product::with('marca','indumentaria','genero','reviews')
    			->paginate(12);
                break;
            case ($genero_id != "null" && $marca_id != "null" && $indumentaria_id == "null"):
                $products = Product::with('marca','indumentaria','reviews','genero')
                ->where('marca_id',$marca_id)
                ->where('genero_id',$genero_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id != "null" && $marca_id == "null" && $indumentaria_id != "null"):
                $products = Product::with('marca','indumentaria','reviews','genero')
                ->where('genero_id',$genero_id)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id != "null" && $indumentaria_id != "null"):
                $products = Product::with('marca','indumentaria','reviews','genero')
                ->where('marca_id',$marca_id)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id != "null" && $indumentaria_id == "null"):
                $products = Product::with('marca','indumentaria','reviews','genero')
                ->where('marca_id',$marca_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id != "null" && $marca_id == "null" && $indumentaria_id == "null"):
                $products = Product::with('marca','indumentaria','reviews','genero')
                ->where('genero_id',$genero_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id == "null" && $indumentaria_id != "null"):
                $products = Product::with('marca','indumentaria','genero','reviews')
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            default:
                $products = Product::with('marca','indumentaria','genero','reviews')
    			->paginate(12);
                //dd($products);
                break;
                //code to be executed
        } 
        return view('vendedores.products',compact('products'));
    }

}
