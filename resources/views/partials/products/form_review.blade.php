@can('review',$product)
<div class="col-12 pt-0 mt-4 text-center">
			<h2 class="text-muted">{{__("Escribe una valoración")}}</h2><hr/>
		</div>

		<div class="container-fluid">
			<form method="POST" action="{{route('products.addReview')}}" class="form-inline" id="rating_form">
				@csrf
				<div class="form-group">
					<div class="col-12">
						<ul id="list_rating" class="list-inline" style="font-size: 40px;">
							<li class="list-inline-item star" data-number="1"><i class="fa fa-star yellow"></i></li>
							<li class="list-inline-item star" data-number="2"><i class="fa fa-star"></i></li>
							<li class="list-inline-item star" data-number="3"><i class="fa fa-star"></i></li>				
							<li class="list-inline-item star" data-number="4"><i class="fa fa-star"></i></li>	
							<li class="list-inline-item star" data-number="5"><i class="fa fa-star"></i></li>	
						</ul>
					</div>
				</div>
				<br />
				<input type="hidden" name="rating_input" value="1" />
				<input type="hidden" name="product_id" value="{{$product->id}}" />
				<div class="form-group">
					<div class="col-12">
						<textarea
							placeholder="{{__("Escribe una reseña")}}"
							id="message"
							name="message"
							class="form-control"
							rows="8"
							cols="80"
						>
						</textarea>
						
					</div>
				</div>
				<div class="col-12 pt-0 mt-4 text-center">
					<button type="submit" class="btn btn-warning text-white">
					<i class="fa fa-space-shuttle"></i> {{__("Valorar producto")}}					
				</button>
				</div>
				
			</form>
			
		</div>
@endcan
	
