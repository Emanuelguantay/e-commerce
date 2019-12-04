<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product_talles;
use App\Marca;
use App\Indumentaria;

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
    	$order = Order::find($id)->load('order_Lines');

    	$orderlines = $order->order_Lines;
    	foreach($orderlines as $orderline){
    		//dd($orderline);
    		$productTalle = Product_talles::find($orderline->product_talle_id);
    		$productTalle->load([
    		'product' => function($q) {
    			$q->select('id','name','description','marca_id','indumentaria_id');
    		},
    		'talle' => function($q){
    			$q->select('id','name');
    		}
    		])->get();
    		
    		$marca = Marca::find($productTalle->product->marca_id);
    		$orderline->marca = $marca->name;

    		$indumentaria = indumentaria::find($productTalle->product->indumentaria_id);
    		$orderline->indumentaria = $indumentaria->name;

    		$orderline->productTalle = $productTalle;
    		//dd($orderline);
    	}
        return view('order.orderdetail', compact('order'));
    }
}
