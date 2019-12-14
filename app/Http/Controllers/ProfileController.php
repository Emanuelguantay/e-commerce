<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\StrengthPassword;

class ProfileController extends Controller
{
    public function index() {
    	//obtenemos el usuario y cargmos la relacion si tiene red social
    	$user = auth()->user()->load('socialAccount');
    	return view('profile.index',compact('user'));
    }

    public function update () {

        if(request()->password != null){
            $this->validate(request(),[
            'password' => ['confirmed', new StrengthPassword]
        ]);

            $user = auth()->user();
            $user->password = bcrypt(request('password'));
            $user->save();
            return back()->with('message', ['success', __("Usuario actualizado correctamente")]);
        }
        else
        {
            return back()->with('message', ['danger', __("Error al modificar")]);
        }
    	
    } 
}
