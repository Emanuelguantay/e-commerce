<div class="card card-01">
	<img 
		class="card-img-top" 
		src="{{$product->pathAttachment() }}"
		alt="{{$product->name}}"
	/>
	<div class="card-body">
		<span class="badge-box"><i class="fa fa-check"></i></span>
		<h4 class="card-title">{{$product->name}}</h4>
			
		<hr />
		<span class="badge badge-danger badge-cat">{{$product->Indumentaria->name}}</span>
		<h3>{{$product->marca->name}}</h3>
		<h2>${{$product->price}}</h2>
		
		<hr />	
		<div class="row justify-content-center">
			{{-- añadir parcial para mostrar el rating--}}
			@include('partials.products.rating', ['rating'=>$product->custom_rating])
		</div>
		<a 
			href="{{route('products.detail', $product->slug)}}"
			class="btn btn-course btn-block" 
		>
			{{__("Mira más")}}	
		</a>
		
	</div>
</div>