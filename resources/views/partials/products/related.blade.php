<div class="col-12 pt-0 mt-4">
	<h2 class="text-muted">
		{{__("También te sugerimos")}}
	</h2>
	<hr />
</div>

<div class="container-fluid">
	<div class="row">
		@forelse($related as $relatedProduct)

			<div class="col-md-6 listing-block" >
				<div class="media">
					<!--scss de related
					<div class="fav-box">
						<i class="fa fa-heart-o" aria-hidden="true"></i>
					</div>-->
					<a href="{{route('products.detail',$relatedProduct->slug)}}">
						<img 
							class="d-flex align-self-start" 
							src="/images/products/{{$relatedProduct->picture}}"
							alt="{{$relatedProduct->name}}"
						/>
					</a>
					<div class="media-body pl-3">
						<div class="price">
							<small>{{$relatedProduct->name}}</small>
						</div>
						<div class="price">
							<small>$ {{$relatedProduct->price}}</small>
						</div>
						<div class="stats">
							@include('partials.products.rating',['rating'=>$relatedProduct->custom_rating])
						</div>
					</div>
				</div>
			</div>
		@empty
			<div class="alert alert-dark">
				{{__("No existe ningún producto relacionado")}}
			</div>

		@endforelse
	</div>
</div>