<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use Exception;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = User::with('role')->where('role_id',2)->get();
        
        //$brands = Marca::paginate(10);
        return view('seller.index', compact('sellers','sellers'));
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
        //
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
        try
        {
            $this->validate($request,[
                'role_id' =>'required',
            ]);
            $seller = User::find($id);

            $seller->role_id = $request->input('role_id');
            $seller->save();

            return back()->with('message', ['success', __("Vendedor modificada")]);
        }catch(Exception $e){

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
            $seller = User::find($id);
            $seller->delete(); 

        return back()->with('message', ['success', __("Vendedor eliminada")]);
        }

        catch(\Illuminate\Database\QueryException $ex){ 
            return back()->with('message', ['danger', __("Error al eliminar")]);
            // Note any method of class PDOException can be called on $ex.
        }
        catch(Exception $e){
            return back()->with('message', ['danger', __("Error al eliminar")]);
        }
    }
}
