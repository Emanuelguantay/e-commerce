<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product_talles;
use App\Order_line;
use App\Marca;
use App\Indumentaria;
use DB;
use Exception;

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

    }

    public function ProductSinStockOrdenpdf() {
        //$orders = Order_line::all();
        
        $products =  \DB::table('product_talles')
                ->select( 'product_talles.id', DB::raw('products.name as productName'),'talles.name', 'product_talles.stock')
                ->join('products', 'product_talles.product_id', '=', 'products.id')
                ->join('talles','product_talles.talle_id', '=', 'talles.id')
                ->where('product_talles.stock', '=', '0')
                
                ->get();

        $pdf = \PDF::loadView('productSize.productSinStockPdf', compact('products'));
        return $pdf->download('products-sin-stock.pdf');
    }

    public function RankingMarcasOrdenpdf() {
        //$orders = Order_line::all();
        
        $marcas =  \DB::table('order_lines')
                ->select( 'marcas.id', 'marcas.name', DB::raw('Count(marcas.id) as cantidad'))
                ->join('product_talles', 'order_lines.product_talle_id', '=', 'product_talles.id')
                ->join('products', 'product_talles.product_id', '=', 'products.id')
                ->join('marcas','products.marca_id', '=', 'marcas.id')
                ->groupBy('marcas.id', 'marcas.name')
                ->orderBy('cantidad','DESC')
                ->get();
        $pdf = \PDF::loadView('productSize.rankingMarcasPdf', compact('marcas'));
        return $pdf->download('ranking-marcas.pdf');
    }

    public function RankingIndumentariasOrdenpdf() {
        //$orders = Order_line::all();
        
        $indumentarias =  \DB::table('order_lines')
                ->select( 'indumentarias.id','indumentarias.name', DB::raw('Count(indumentarias.id) as count'))
                ->join('product_talles', 'order_lines.product_talle_id', '=', 'product_talles.id')
                ->join('products', 'product_talles.product_id', '=', 'products.id')
                ->join('indumentarias','products.indumentaria_id', '=', 'indumentarias.id')
                ->groupBy('indumentarias.id', 'indumentarias.name')
                ->orderBy('count','DESC')
                ->get();
        $pdf = \PDF::loadView('productSize.rankingIndumentariasPdf', compact('indumentarias'));
        return $pdf->download('ranking-indumentarias.pdf');
    }


    public function RankingGenerosOrdenpdf() {
       
        $generos =  \DB::table('order_lines')
                ->select( 'generos.id','generos.name', DB::raw('Count(generos.id) as count'))
                ->join('product_talles', 'order_lines.product_talle_id', '=', 'product_talles.id')
                ->join('products', 'product_talles.product_id', '=', 'products.id')
                ->join('generos','products.genero_id', '=', 'generos.id')
                ->groupBy('generos.id', 'generos.name')
                ->orderBy('count','DESC')
                ->get();
        $pdf = \PDF::loadView('productSize.rankingGenerosPdf', compact('generos'));
        return $pdf->download('ranking-generos.pdf');
    }
}

/*
SELECT indumentarias.id, indumentarias.name, COUNT(indumentarias.id) as count
FROM order_lines
inner join product_talles on (order_lines.product_talle_id = product_talles.id)
inner join products on (product_talles.product_id = products.id)
inner join indumentarias on (products.indumentaria_id = indumentarias.id)
GROUP BY (indumentarias.id, indumentarias.name)
order by  count DESC
*/

        /*
        //consulta sql
SELECT products.name, talles.name, order_lines.product_talle_id,Sum(order_lines.qty) AS Expr1
FROM order_lines
inner join product_talles on (order_lines.product_talle_id = product_talles.id) 
inner join products on (product_talles.product_id = products.id)
inner join talles on (product_talles.talle_id = talles.id)
GROUP BY (products.name, talles.name,order_lines.product_talle_id)
order by  Expr1 DESC

select product_talles.id, products.name,  talles.name, product_talles.stock
from product_talles
inner join products on (product_talles.product_id = products.id)
inner join talles on (product_talles.talle_id = talles.id)
where (product_talles.stock = 0)
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
    


