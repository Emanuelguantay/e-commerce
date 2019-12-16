<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product_talles;
use App\Order_line;
use App\Marca;
use App\Indumentaria;
use DB;


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


    public function pdf() {
		$orders = Order::all();
		
		//dd($orders);
		$pdf = \PDF::loadView('order.pdfOrder', compact('orders'));
		return $pdf->download('listado.pdf');
	}

    public function rankingProductOrdenpdf() {
        //$orders = Order_line::all();
        
        $ranking =  \DB::table('order_lines')
                ->select(DB::raw('products.name as productName'), 'talles.name', 'order_lines.product_talle_id',DB::raw('sum(order_lines.qty) as cantidad'))
                ->join('product_talles', 'order_lines.product_talle_id', '=', 'product_talles.id')
                ->join('products', 'product_talles.product_id', '=', 'products.id')
                ->join('talles','product_talles.talle_id', '=', 'talles.id') 
                ->groupBy('products.name', 'talles.name','order_lines.product_talle_id')
                ->orderBy('cantidad','DESC')
                ->get();
        //dd($ranking);
        //SELECT ventas.producto, Sum(1) AS Expr1
        //FROM ventas
        //GROUP BY ventas.producto
        //dd($orders);
        $pdf = \PDF::loadView('productSize.rankingPdf', compact('ranking'));
        return $pdf->download('ranking-productos-mas-vendidos.pdf');

        /*
        //consulta sql
        SELECT products.name, talles.name, order_lines.product_talle_id,Sum(order_lines.qty) AS Expr1
FROM order_lines
inner join product_talles on (order_lines.product_talle_id = product_talles.id) 
inner join products on (product_talles.product_id = products.id)
inner join talles on (product_talles.talle_id = talles.id)
GROUP BY (products.name, talles.name,order_lines.product_talle_id)
order by  Expr1 DESC
        */

        /* //ejemplo
        $despachos=DB::table('despachos')
            ->join('productos', 'despachos.id_producto', '=', 'productos.id')
            ->where('despachos.id_cliente', '=', $id)
             ->whereBetween('despachos.fecha', array($fechain,$fechater))
            ->select('productos.nombre',DB::raw('sum(despachos.cantidad) as cantidad'),DB::raw('sum(total) as total'))
            ->groupBy('despachos.id_producto')
            ->get();
        */
        
    }

    
}
