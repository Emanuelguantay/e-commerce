<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Marca::all();
        //$brands = Marca::paginate(10);
        return view('brand.index', compact('brands','brands'));
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
        $this->validate($request,[
            'bName' =>'required'
        ]);
        $brand = new Marca;

        $brand->name = $request->input('bName');
        $brand->description = $request->input('bDescription');
        $brand->save();

        return back()->with('message', ['success', __("Marca agregada")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $this->validate($request,[
            'bName' =>'required'
        ]);
        $brand = Marca::find($id);

        $brand->name = $request->input('bName');
        $brand->description = $request->input('bDescription');
        $brand->save();

        return back()->with('message', ['success', __("Marca modificada")]);
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
            $brand = Marca::find($id);
            $brand->delete(); 

        return back()->with('message', ['success', __("Marca eliminada")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
        

    }
}
