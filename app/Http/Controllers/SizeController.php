<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talle;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Talle::all();
        //$sizes = Talle::paginate(10);
        return view('size.index', compact('sizes','sizes'));
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
            'bName' =>'required'
        ]);
        $size = new Talle;

        $size->name = $request->input('bName');
        $size->description = $request->input('bDescription');
        $size->save();

        return back()->with('message', ['success', __("Talle agregada")]);
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
            'bName' =>'required'
        ]);
        $size = Talle::find($id);

        $size->name = $request->input('bName');
        $size->description = $request->input('bDescription');
        $size->save();

        return back()->with('message', ['success', __("Talle modificada")]);
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
            $size = Talle::find($id);
            $size->delete(); 

        return back()->with('message', ['success', __("Talle eliminada")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
    }
}
