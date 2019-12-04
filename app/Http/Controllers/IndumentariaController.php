<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indumentaria;

class IndumentariaController extends Controller
{
    public function index(){
    	$clothes = Indumentaria::all();
    	return view('indumentarias.index')->with(compact('clothes'));
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
        $clothes = new Indumentaria;

        $clothes->name = $request->input('bName');
        $clothes->description = $request->input('bDescription');
        $clothes->save();

        return back()->with('message', ['success', __("Indumentaria agregada")]);
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
        $this->validate($request,[
            'bName' =>'required'
        ]);
        $clothes = Indumentaria::find($id);

        $clothes->name = $request->input('bName');
        $clothes->description = $request->input('bDescription');
        $clothes->save();

        return back()->with('message', ['success', __("Indumentaria modificada")]);
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
            $clothes = Indumentaria::find($id);
            $clothes->delete(); 

        return back()->with('message', ['success', __("Indumentaria eliminada")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
    }
}
