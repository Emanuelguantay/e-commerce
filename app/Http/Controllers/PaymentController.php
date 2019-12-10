<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Mail;
use App\Order;
use App\Order_line;

use Exception;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal'); //levanta la conf. de paypal.php
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    public function index(Request $request)
    {
        //dd($request);
    	//$request_data  = $request->all();
        $costo = $request->input('precio');
        return view('paypal.pagarconpaypal',compact('costo'));
        //return view('paypal.pagarconpaypal',['costo'=>'costo']);
    }


    public function payWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/pago');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/pago');
            }
        }
        //catch para capturar errores
        //catch(Exception $e){
        //    return Redirect::to('/cart/show')->with('message', ['danger', __("Error")]);
        //}

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/pago');
    }


    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/pago');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        $address = $result->payer->payer_info->shipping_address;
        $nameAddress = $address->line1;
        //dd($address);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            //TODO: logica para cargar en base de datos los productos y borrar carrito
            
            $this->saveOrder($nameAddress);
            \Session::forget('cart');
            //dd($cart);

            return Redirect::to('/pago');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::to('/pago');
    }

    protected function saveOrder($nameAddress)
    {
        $cart = \Session::get('cart');
        //dd($cart);
        $subtotal = 0;
        foreach ($cart as $product) {
            $subtotal += $product->quantity * $product->price; 
        }
        //Crear Orden
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total' => $subtotal,
            'address' => $nameAddress
        ]);
        
        //Crear Order line
        foreach ($cart as $product) {
            $this->saveOrderLine($product, $order->id);
        }
        $this->sendMailThanks($cart);
    }

    protected function saveOrderLine($product, $orderId)
    {
        Order_line::create([
            'order_id' => $orderId,
            'product_talle_id' => $product->product_talle->id,
            'product_price' => (float) $product->price,
            'qty' => $product->quantity
        ]);
    }


    public function sendMailThanks($cart) {
      $user = auth()->user();
      $data = array('name'=>$user->name,
                    'email'=>$user->email,
                    'cart'=> $cart
                    );
      Mail::send('mail.sendThanks', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject
            ('Bienvenido');
         $message->from('ecommerce.ema@gmail.com','Ecommerce');
      });
    }



}
