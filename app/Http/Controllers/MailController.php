<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

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
	
	/*
    public function sendBasicMail(){
    	
		$subject = 'Asunto del correo';
		$from = 'emanuel.guantay92@gmail.com';
		$sender = 'PAW 2017 at DI';
		$advertising='PAW 2017 by Laravel 5.5';
		$data = array('advertising'=>$advertising);
		//dd($data);
		Mail::send('mail.sending', $data, function($message) use ($advertising){
			$message­->to('emanuelguantay92@gmail.com', 'Emanuel')->subject('Greetings from PAW');

			$message­->from('emanuelguantay92@gmail.com','PAW by Laravel');
		});
		
		//echo 'Basic email sent successfully. Please check your mail.';
		//return view('welcome');
	}
	/*
	public function sendAttachmentMail(){
		dd('entro2');
		$data = array('name'=>'XXX');
		Mail::send('mail.sending', $data, function($message) {
			$message­->to('emanuelguantay92@gmail.com', 'Emanuel')­->subject($subject);
			$message­->attach('...\image.png');
			$message­->attach('..\test.txt');
			$message­->from($subject,$sender);
		});
		echo 'Email sent with attachment. Please check your mail.';
	}*/
		
}
