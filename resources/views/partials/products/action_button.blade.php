<div class="col-2">

	@auth
		<!--puede mejorar policy!!!! can('opt_for_product')-->
			<!--href={route('subscriptions.plans')}}-->

			<!--<form method="POST" action="{{route('cart.store')}}" class="form-inline" id="rating_form">-->
			@if($product->talles_count >0)
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
							@if($talle->pivot->stock > 0)
								<option value="{{$talle->pivot->id}}">{{$talle->name}} ({{$talle->pivot->stock}})</option>
							@else
								<option style="background-color: Gray;color: #FFFFFF;" disabled="true" value="{{$talle->pivot->id}}">{{$talle->name}} (Sin stock)</option>
							@endif
						@empty
							
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
			@else
				<div class=" py-2 px-2 my-2">
						<h4>{{__("Disculpe, no se encuentra disponible este producto.")}}</h4>
					</div>
			@endif
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
