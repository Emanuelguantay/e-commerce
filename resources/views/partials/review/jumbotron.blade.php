<div class="row mb-4">
	<div class="col-md-12">
		<div class="card" style="background-image: url('{{ url('/images/jumbotron2.jpg') }}')">
			<div class="text-white text-center d-flex align-center py-2 px-4">
				<div class="col-4">
					<img class="img-fluid" src="{{$product->pathAttachment()}}" />
				</div>
				<div class="col-5 text-left">
					<h1>{{$product->marca->name}}</h1>
					<h1>{{$product->indumentaria->name}}</h1>
					<h2>{{$product->name}}</h2>
					<h1>$ {{$product->price}}</h1>
					
					<h5>{{__("Fecha de publicación")}}: {{$product->created_at->format('d/m/Y')}}</h5>
					<h6>{{__("Número de valoraciones")}}: {{$product->reviews_count}}</h6>
					@include('partials.products.rating',['rating'=>$product->custom_rating])
				</div>
			</div>
		</div>
	</div>
</div>
