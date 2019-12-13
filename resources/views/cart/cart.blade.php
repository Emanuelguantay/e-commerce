@extends('layouts.app')

@section('jumbotron')
	@include('partials.jumbotron',['title'=> __('Carrito de compra'), 'icon'=> 'shopping-cart'])
@endsection

@section('content')
	@if(!empty($cart))
		<table class="table">
			<thead>
				<tr>
					<th class="text-center"> #</th>
					<th class=" text-center">Nombre</th>
					<th class=" text-center">Talle</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th class="text-right">SubTotal</th>
					<th class="text-right">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<input type="hidden" name="precio_total" value="{{$precio=0}}"/>
				
				@foreach ($cart as $detail)
				
				<tr>
					<td class="text-center">

						<img src="{{$detail->pathAttachment()}}" height="50">
						
					</td>
					<td>
						
						<a href="{{route('products.detail', $detail->slug)}}" target="_blank">{{$detail->name}}</a>
						
						
					</td>
					<td>

						<h4>{{$detail->sizename}}</h4>
					</td>
					<td >$ {{$detail->price}}</td>
					<td>
						<!--
						<input 
							type="number"
							min="1"
							max="{$detail->product_talle->stock}}"
							value="{$detail->quantity}}"
							 
							id="product_{$detail->product_talle->id}}" 
							name=""
							/>
						-->
						<div class="row">
							<div class="qty-changer">
	            				<!--<button class="quantity-left-minus btn btn-danger btn-simple btn-xs" data-href="">-</button>-->
	            				
	            				<a 
	            					href="#"
	            					class="quantity-left-minus btn btn-danger btn-simple btn-xs"
	            					data-href="{{route('cart.update', $detail->product_talle->id)}}"
	            					data-id = "{{$detail->product_talle->id}}"
	            				>
	            					
	            				</a>
	            				<input 
	            					class="btn-simple btn btn-xs" 
	            					type="number"
	            					min="1"
	            					disabled="true" 
	            					max="{{$detail->product_talle->stock}}" 
	            					value="{{$detail->quantity}}"
	            					id="product_{{$detail->product_talle->id}}"
	            					name="quantity"
	            				/>
	            				<a 
	            					href="#"
	            					class="quantity-right-plus btn btn-info btn-simple btn-xs"
	            					data-href="{{route('cart.update', $detail->product_talle->id)}}"
	            					data-id = "{{$detail->product_talle->id}}"
	            					data-stock = "{{$detail->product_talle->stock}}" 
	            				>
	            					
	            				</a>
	            				<!--route('cart-update', $detail->slug)-->
	            				<!--<button class="btn btn-info btn-simple btn-xs">+</button>-->
	        				</div>
						</div>
					</td>
					<td  class="text-right">$ {{$detail->quantity * $detail->price}}</td>

					<td class="td-actions text-right">	
						<form method="POST" action="{{route('cart.destroy')}}">
							@csrf
							<a href="{{route('products.detail', $detail->slug)}}" target="_blank" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
								<i class="fa fa-info"></i>

							</a>
								
								<!--value="{{$detail->id}}"-->
								<input type="hidden" name="detail_id" value="{{$detail->product_talle->id}}" />							<button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
									<i class="fa fa-times"></i>
								</button>
						</form>
					</td>
				</tr>
				<input type="hidden" name="precio_total" value="{{$precio=$precio + $detail->quantity * $detail->price}}"/>
				
				@endforeach
			</tbody>
		</table>

		
		<div class="col-11 text-right">

			<h2>Precio Total: $ {{$precio}}</h2>
		</div>
			<!--include('order.action_button_pago',['costo' => $precio])-->
		<div class="col-11 text-right">
			@auth
				<form method="POST" action="{{route('paypal.index')}}"  >
					@csrf
					<input type="hidden" name="precio" value="{{$precio}}"/>
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
	@else
	<div class="alert alert-dark text-center">
                {{__("Tu carrito está vacío")}}
    </div>
    <div class="text-center">
    	<a class="btn btn-subscribe btn-bottom " href="{{route('home')}}">
			<i class="fa fa-shopping-cart"></i> {{__("Continuar comprando")}}
		</a>
    </div>
	@endif
		
	
@endsection