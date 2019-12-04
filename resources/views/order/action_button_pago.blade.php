

	<!--<div class="col-3">-->
	<div class="col-11 text-right">
		@auth
			<form method="POST" action="{{route('paypal.index',['costo' => $precio])}}"  >
				@csrf
				
				<button type="submit" class="btn btn-subscribe btn-bottom ">
					<i class="fa fa-bolt"></i> {{__("Concluir compra")}}				
				</button>
			</form>
		@else
			<a class="btn btn-subscribe btn-bottom " href="{{route('login')}}">
				<i class="fa fa-bolt"></i> {{__("Concluir compra")}}
			</a>
		@endauth
	</div> 