@extends('layouts.app')

@section('jumbotron')
	@include('partials.jumbotron',['title'=> __('Carrito de compra'), 'icon'=> 'shopping-cart'])
@endsection

@section('content')
	
	<table class="table">
		<thead>
			<tr>
				<th class="text-center"> #</th>
				<th class=" text-center">Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th class="text-right">SubTotal</th>
				<th class="text-right">Opciones</th>
			</tr>
		</thead>
		<tbody>
			<input type="hidden" name="precio_total" value="{{$precio=0}}"/>
			
			@foreach ($cartDetail as $detail)
			<tr>
				<td class="text-center">
					<img src="{{$detail->product->pathAttachment()}}" height="50">
				</td>
				<td>


					<a href="{{route('products.detail', $detail->product->slug)}}" target="_blank">{{$detail->product->name}}</a>
				</td>
				<td >$ {{$detail->product->price}}</td>
				<td>{{$detail->qty}}</td>
				<td class="text-right">$ {{$detail->qty * $detail->product->price}}</td>

				<td class="td-actions text-right">	
					<form method="POST" action="{{route('cart.destroy')}}">
						@csrf
						<a href="{{route('products.detail', $detail->product->slug)}}" target="_blank" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
							<i class="fa fa-info"></i>

						</a>
						
							<input type="hidden" name="detail_id" value="{{$detail->id}}" />
							<button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
								<i class="fa fa-times"></i>
							</button>
					</form>
					
				</td>
			</tr>
			<input type="hidden" name="precio_total" value="{{$precio=$precio + $detail->qty * $detail->product->price}}"/>
			
			@endforeach
		</tbody>
	</table>

	
	<div class="col-11 text-right">

		<h2>Precio Total: $ {{$precio}}</h2>
	</div>
		@include('order.action_button_pago',['costo' => $precio])
		
	
@endsection