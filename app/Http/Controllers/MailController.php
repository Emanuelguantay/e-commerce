<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;

class MailController extends Controller
{
	public function sendBasicMail() {
   	  $name='Emanuel';
   	  $data = array('name'=>$name);
      Mail::send('mail.sending', $data, function($message) {
         $message->to('emanuelguantay92@gmail.com', 'Usuario')->subject
            ('Bienvenido');
         $message->from('ecommerce.ema@gmail.com','Ecommerce');
      });
      echo "Email enviado!";
   }

   public function sendMailAll(){
	$users = User::all();
	foreach($users as $user)
	{
		$data = array('name'=>$user->name,
                    'email'=>$user->email);
	    Mail::send('mail.sendWelcome', $data, function($message) use ($data) {
	         $message->to($data['email'], $data['name'])->subject
	            ('Oferta');
	         $message->from('ecommerce.ema@gmail.com','Ecommerce');
	      });
   	}
   }
	
		
}
