<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Talle;
use App\Product_talles;
use Exception;

class CartController extends Controller
{
    public function __construct()
    {
        //traductor si no existe lo creo
    	if(!\Session::has('cart')) \Session::put('cart',array());
    }

    public function show()
    {
    	$cart = \Session::get('cart');

        //dd($cart);
        return view('cart.cart', compact('cart'));
    }

    //ver de optimizar porque obtengo request y product
    //creo q esta bien
    public function add(Request $request)
    {
        try{
            //dd($request);
            $cart = \Session::get('cart');
            $cart_line = Product::find($request->product_id);

            //carga producto
            $product_talle = Product_talles::find($request->product_size_id);
            $talle = Talle::find($product_talle->talle_id);
            $cart_line->sizename = $talle->name;
            $cart_line->product_talle = $product_talle;

            if (array_key_exists($request->product_size_id, $cart)){
                //dd($product_talle);
                $cant = (int) $cart[$request->product_size_id]->quantity;
                $cantSum = $cant +1;
                if($product_talle->stock >=$cantSum )
                {
                    $cart_line->quantity = $cantSum;
                }else{
                    $cart_line->quantity = $cant;
                }
                
            }else{
                $cart_line->quantity = 1;
            }

            $cart[$request->product_size_id] = $cart_line;
            \Session::put('cart',$cart);
            return redirect()->route('cart.index');
            return back()->with('message', ['success', __("Agregado al carrito")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al guardar")]);
        }

    }

    /*
    //andaba hasta el 20
    public function add(Request $request)
    {
        //dd($request);
    	$cart = \Session::get('cart');
        $cart_line = Product::find($request->product_id);
        //dd($cart_line->talles);
        //$product_size = Talle::find($request->product_size_id);
        //$cart[$product_size] = $request->product_size_id;
        //dd($request);
        //dd($request);
        //$sizename = Product::with('talles')->find(11);
        //sacar el if porque todos tienen talle

        if ($request->product_size_id != "Talle unico"){
            
            $product_talle = Product_talles::find($request->product_size_id);
            $talle = Talle::find($product_talle->talle_id);
            $cart_line->sizename = $talle->name;
            $cart_line->product_talle = $product_talle;
        }
        
        //dd($talle);

        //ver si mandar solamente el product talle y despues buscar cada uno..
        //ver de optimizar
        
    	$cart_line->quantity = 1;
        
        //$cart_item[$cart_line->slug] = $cart_line;
        
        //$cart = array_add($cart, $cart_line->slug, $cart_line);
        if (array_key_exists($request->product_size_id, $cart)){
            dd("entro");
        }else{
            dd("entro else");
        }

        dd($cart[$request->product_size_id]);
    	$cart[$request->product_size_id] = $cart_line;
        //dd($cart);
    	\Session::put('cart',$cart);
        //\Session::put($cart_line->slug,$cart_line);
    	return redirect()->route('cart.index');
        return back()->with('message', ['success', __("Agregado al carrito")]);

    }*/

    public function destroy(Request $request){
        try{
            $cart = \Session::get('cart');
            $deleteId=$request->detail_id;
            unset($cart[$deleteId]);
            \Session::put('cart',$cart);
            return back()->with('message', ['success', __("Eliminado del carrito satisfactoriamente.")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al borrar")]);
        }
        
    }
    public function update($product, $quantity){
        try{
            $cart = \Session::get('cart');
            $cart[$product]->quantity=$quantity;
            
            \Session::put('cart',$cart);
            //\Session::put($cart_line->slug,$cart_line);
            return redirect()->route('cart.index');
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al modificar")]);
        }
        
    }
}
