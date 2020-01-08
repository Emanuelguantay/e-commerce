<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use Exception;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Genero::all();
        //$genders = Genero::paginate(10);
        return view('genders.index', compact('genders','genders'));
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
        $gender = new Genero;

        $gender->name = $request->input('bName');
        $gender->save();

        return back()->with('message', ['success', __("Genero agregada")]);
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
        $gender = Genero::find($id);

        $gender->name = $request->input('bName');
        $gender->save();

        return back()->with('message', ['success', __("Genero modificada")]);
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
            $gender = Genero::find($id);
            $gender->delete(); 

        return back()->with('message', ['success', __("Genero eliminada")]);
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
    }
}
