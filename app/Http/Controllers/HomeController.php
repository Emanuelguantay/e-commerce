<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withCount(['talles'])->
              with('marca','indumentaria','reviews','talles')
            ->where('status', Product::PUBLISHED)
            //ordenado decsendente
            ->latest()
            ->paginate(12);
        //dd($products);
        return view('home',compact('products'));
    }

    public function list(Request $request)
    {
        //$input = $request->all();
        //dd($input);
        $genero_id = $request->input('genero_id');
        $marca_id = $request->input('marca_id');
        $indumentaria_id = $request->input('indumentaria_id');
        switch (true) {
            case ($genero_id != "null" && $marca_id != "null" && $indumentaria_id != "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('marca_id',$marca_id)
                ->where('genero_id',$genero_id)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id != "null" && $marca_id != "null" && $indumentaria_id == "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('marca_id',$marca_id)
                ->where('genero_id',$genero_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id != "null" && $marca_id == "null" && $indumentaria_id != "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('genero_id',$genero_id)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id != "null" && $indumentaria_id != "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('marca_id',$marca_id)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id != "null" && $indumentaria_id == "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('marca_id',$marca_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id != "null" && $marca_id == "null" && $indumentaria_id == "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('genero_id',$genero_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            case ($genero_id == "null" && $marca_id == "null" && $indumentaria_id != "null"):
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                ->where('indumentaria_id',$indumentaria_id)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                break;
            default:
                $products = Product::withCount(['talles'])->
                  with('marca','indumentaria','reviews','talles')
                ->where('status', Product::PUBLISHED)
                //ordenado decsendente
                ->latest()
                ->paginate(0);
                //dd($products);
                break;
                //code to be executed
        } 
        return view('home',compact('products'));
    }

}
