<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\UserSocialAccount;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request){
        //ver si borro auth()->logout cierra
        auth()->logout();
        //elimina todo los datos de la session
        session()->flush();
        return redirect('/login');
    }
    

        //redirect a la plataforma q estabamos usando, para pedir los permisos
    public function redirectToProvider (string $driver) {
        return Socialite::driver($driver)->redirect();
    }
    //accedemos al usuario que nos devolvio la plataforma
    public function handleProviderCallback (string $driver) {
    
        if (!request()->has('code') || request()->has('denied')){
            //flash me permite almacenar en session un message,
            session()->flash('message',['danger',__('Inicio de sesión cancelado')]);
            return redirect('login');
        }
        //este dato me devuelve facebook
        try{
            $socialUser = Socialite::driver($driver)->user();
            //error si ya tengo iniciado faccebook
            $user = null;
        $success = true;
        $email = $socialUser->email;
        //metodos magicos para buscar el email y obtener el primer registro
        $check = User::whereEmail($email)->first();
        if($check){
            $user=$check;
        }else{
            //begintransactiion es para tener el poder absoluto y hacerlo manual
            \DB::beginTransaction();
            try{
                //into a la tabla user
                $user = User::create([
                    "name" => $socialUser->name,
                    "email" => $email
                ]);
                UserSocialAccount::create([
                    "user_id" => $user->id,
                    "provider" => $driver,
                    "provider_uid" => $socialUser->id,
                ]);
            }catch(\Exception $exception){
                $success= "Error al ingresar con facebbok";
                \DB::rollback();
            }
        }

        if ($success === true) {
            \DB::commit();
            auth()->loginUsingId($user->id);
            return redirect(route('home'));
        }
        }catch(\Exception $exception){
            $success= $exception->getMessage();
        }
        
        //para hacer una impresion de la info del usuario
        
        
        session()->flash('message',['danger',$success]);
        return redirect('login');
    
    }
}
