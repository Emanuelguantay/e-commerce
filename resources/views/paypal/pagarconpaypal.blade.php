<!DOCTYPE html>
<html>
<head>
	<title>Formulario Paypal</title>
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
	<div class="w3-container">
        @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
        @endif

        @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
        @endif
		<form class = "w3-container w3-display-middle w3-card-4" method = "POST" id = "payment-form" action = "{!!URL::to('paypal')!!}"> 
	  		{{csrf_field ()}} 
	  		<h2 class = "w3-text-blue"> Formulario de pago </h2> 
	  		<p> Formulario de PayPal</p> 


            @isset($costo)
    	  		<p> <label class = "w3-text-blue"> <b> El monto a pagar es de: $ {{$costo}}  </b> </label>
                <input class="w3-input w3-border" name="amount" value="{{$costo}}" type="hidden"></p>
                    
    	  		<div class="text-center">
    	  			<button class = "w3-btn w3-blue "> Pagar con PayPal </button> </p> 
    	  		</div>	      
            @endisset
	  		
	  	</form>
	</div>
</form>
</body>
</html>


