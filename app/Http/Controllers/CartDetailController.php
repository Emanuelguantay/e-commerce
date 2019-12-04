<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_line;

class CartDetailController extends Controller
{
	 //carrito de compra
    

    public function store(Request $request){
        //$valor_almacenado = session('idCarrito');
        //dd($valor_almacenado);
        //dd(request()->all());
    	dd($request);
        $cartDetail = new Order_line();
    	$cartDetail->order_id = auth()->user()->order->id;
    	$cartDetail->product_id = $request->product_id;
    	$cartDetail->qty =  1;
    	$cartDetail->product_price = (float) $request->price;
    	
        //session(['idCarrito' => $cartDetail]);
        //$cartDetail->save();
    	return back()->with('message', ['success', __("Agregado al carrito")]);
    }

    public function index (){
        $cartDetail = auth()->user()->order->orderLines;
        //dd($cartDetail);
        return view('order.index',compact('cartDetail'));
    }

    public function destroy(Request $request){
        $cartDetail = Order_line::find($request->detail_id);
        if($cartDetail->order_id == auth()->user()->order->id){
            $cartDetail->delete();
        
            return back()->with('message', ['success', __("Eliminado del carrito satisfactoriamente.")]);
        }
    }
/*
    public function index() {
        //obtenemos el usuario y cargmos la relacion si tiene red social
        //order entra a este controler ---->>>> getOrderAttribute()
        $cartDetail = auth()->user()->order->orderLines;
        return view('order.index',compact('cartDetail'));
    }
  
 */  

/*
    public function destroy(Request $request){
    	dd($request);
    	$cartDetail = new Order_line::find($request->id);
    	$cartDetail->delete();

    	return back();
    }
*/

/*
    Review::create([
            "user_id" => auth()->id(),
            "course_id" => request('course_id'),
            "rating" => (int) request('rating_input'),
            "comment" => request('message')
        ]);
        return back()->with('message', ['success', __("Muchas gracias por valorar el curso")]);
*/
}


