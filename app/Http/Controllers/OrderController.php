<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
    	//dd(auth()->user()->order->id);
        $orders = Order::where('user_id',auth()->user()->id)->get();
        //dd($order);
        //$brands = Marca::paginate(10);
        return view('order.index', compact('orders','orders'));
        //return view('order.index');
    }


    public function show($id){
    	$orderDetail = Order::find($id)->load('order_Lines');
    	/*#attributes: array:8 [▼
            "id" => 2
            "order_id" => 5
            "product_talle_id" => 10
            "product_price" => "6"
            "qty" => 3
            "status" => "PENDING"
            "created_at" => "2019-12-04 00:16:26"
            "updated_at" => "2019-12-04 00:16:26"
          ] */
        //TODO: Cargar el detalle de la orden
        dd($orderDetail);
        return view('order.orderdetail', compact('orderDetail'));
    	
    }
}
