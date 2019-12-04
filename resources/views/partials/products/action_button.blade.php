<div class="col-2">

	@auth
		<!--puede mejorar policy!!!! can('opt_for_product')-->
			<!--href={route('subscriptions.plans')}}-->

			<!--<form method="POST" action="{{route('cart.store')}}" class="form-inline" id="rating_form">-->

			<form method="POST" action="{{route('cart.add', $product->slug)}}" class="form-inline" id="rating_form">
				@csrf
				
				<!--
				<a class="btn btn-subscribe btn-bottom btn-block" href="#">
					<i class="fa fa-bolt"></i> {__("Comprar")}}
				</a>-->
				<div class=" py-2 px-2 my-2">
					<select name="product_size_id" id="size_name" class="form-control" required>
						<option value="">{{__("Seleccione Talle")}}</option>
					@forelse($product->talles as $talle)
						<option value="{{$talle->pivot->id}}">{{$talle->name}}</option>
					@empty
						<option value="Talle unico">Talle unico</option>
					@endforelse
					</select>
				</div>
				<!--Seleccionar cantidad se fue al carrito de compra-->
				<!--<div class=" py-2 px-2 my-2">
					<p> Cantidad ($talle->id)</p>

					<input type="number" name="edad" min="1" max="100" placeholder="Cantidad" required>
				</div>-->
				<input type="hidden" name="price" value="{{$product->price}}" />
				<input type="hidden" name="product_id" value="{{$product->id}}" />
				<!--<a class="btn btn-subscribe" href="{{route('cart.add', $product->slug)}}">
					<i class="fa fa-bolt"></i> {{__("Comprar")}}
				</a>-->
				<button type="submit" class="btn btn-subscribe btn-bottom btn-block" >

					<i class="fa fa-bolt"></i> {{__("Comprar")}}					
				</button>
			</form>
		<!--else
			<a class="btn btn-subscribe btn-bottom btn-block" href="#">
				<i class="fa fa-user"></i> {__("Soy vendedor")}}
			</a>
		endcan-->
	@else
		
		<a class="btn btn-subscribe btn-bottom btn-block" href="{{route('login')}}">
			<i class="fa fa-bolt"></i> {{__("Comprar")}}
		</a>
	@endauth
</div>
