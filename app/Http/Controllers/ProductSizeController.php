<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_talles;
use App\Marcas;
use App\Indumentarias;
use App\Generos;
use Exception;
class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id)->load('talles','marca','indumentaria','genero');
        return view('productSize.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $this->validate($request,[
            'size_id' =>'required',
            'stock' =>'required',
            'product_id' =>'required'
        ]);
        $productTalle = new Product_talles;

        $productTalle->product_id = $request->input('product_id');
        $productTalle->talle_id = $request->input('size_id');
        $productTalle->stock = $request->input('stock');
        
        $productTalle->save();


        $product = Product::find($request->input('product_id'));
        if ($product->status==Product::PENDING)
        {
            $product->status = Product::PUBLISHED;
            $product->save();
        }

        return back()->with('message', ['success', __("Talle agregado")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al guardar")]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        $this->validate($request,[
            'size_id' =>'required',
            'stock' =>'required',
            'product_id' =>'required'
        ]);
        $productTalle = Product_talles::find($id);
        $productTalle->product_id = $request->input('product_id');
        $productTalle->talle_id = $request->input('size_id');
        $productTalle->stock = $request->input('stock');
        $productTalle->save();

        return back()->with('message', ['success', __("Talle modificado")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al modificar")]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $productTalle = Product_talles::find($id);
            $productTalle->delete(); 

        return back()->with('message', ['success', __("Talle eliminada")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
    }
}
