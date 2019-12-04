@extends('layouts.app')

@section('jumbotron')
	@include('partials.jumbotron',['title' => __('Productos'), 'icon' => 'th'])
@endsection

@section('content')
	<div class="pl-5 pr-5">
		<div class="row justify-content-center">
			@forelse($products as $product)
				<div class="col-md-9 offset-2 listing-block">
					<div class="media" style="height: 200px;">
						<img
							style="height: 200px; width: 300px;"
							class="img-rounded" 
							src="{{$product->pathAttachment()}}"
							alt="{{$product->name}}"
						/>

						<div class="media-body pl-3" style="height: 200px">
							<div class="price">
								<small class="badge-danger text-white text-center">
									{{ $product->marca->name}}
								</small>
								<small class="badge-primary text-white text-center">
									{{ $product->indumentaria->name}}
								</small>
								<small>{{__("Nombre")}}: {{$product->name}}</small>
								<small>{{__("Precio")}}: $ {{$product->price}}</small>
							</div>
							<div class="stats">
								@include('partials.products.rating', ['rating' => $product->custom_rating])
							</div>

							@include('partials.products.vendedor_action_buttons')
								
						</div>
					</div>
				</div>
			@empty
				<div class="alert alert-dark">
					{{__("No tienes ningún curso todavia")}} <br />
					<a class="btn btn-product btn-block" href="{{route('products.create')}}">
						{{__("Crear producto!")}}	
					</a>
				</div>
				
					
			@endforelse

		</div>
		<div class="row justify-content-center">
			{{$products->links()}}
			
		</div>
	</div>
@endsection