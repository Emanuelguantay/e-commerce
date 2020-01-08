<div class="btn-group">
	
	@if((int) $product->status === \App\Product::PUBLISHED)
		<a class="btn btn-course" href="{{ route('products.detail', ["slug" => $product->slug]) }}">
			<i class="fa fa-eye"></i> {{__("Detalle")}}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('products.edit', ["slug" => $product->slug]) }}">
			<i class="fa fa-pencil"></i> {{__("Editar")}}
		</a>
		<a class="btn btn-info" href="{{url('productsize',$product->id)}}">
                 <i class="fa fa-"></i> {{__("Talles")}}
                                    </a>
		@include('partials.products.btn_forms.delete')
	@elseif ((int) $product->status === \App\Product::PENDING)
		@if (auth()->user()->role_id === \App\Role::ADMIN)
			<a class="btn btn-primary text-white" href="{{ route('products.alta', ["slug" => $product->slug]) }}">
				<i class="fa fa-thumbs-up"></i> {{__("Dar de alta")}}
			</a>
		@else
			<a class="btn btn-primary text-white" href="#">
				<i class="fa fa-history"></i> {{__("Producto pendiente de revisión")}}
			</a>
		@endif
		<a class="btn btn-course" href="{{ route('products.detail', ["slug" => $product->slug]) }}">
			<i class="fa fa-eye"></i> {{__("Detalle")}}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('products.edit', ["slug" => $product->slug]) }}">
			<i class="fa fa-pencil"></i> {{__("Editar")}}
		</a>
		@include('partials.products.btn_forms.delete')
	@else
		@if (auth()->user()->role_id === \App\Role::ADMIN)
			<a class="btn btn-danger text-white" href="#">
				<i class="fa fa-pause"></i> {{__("Producto Eliminado")}}
			</a>
			<a class="btn btn-primary text-white" href="{{ route('products.alta', ["slug" => $product->slug]) }}">
				<i class="fa fa-thumbs-up"></i> {{__("Dar de alta")}}
			</a>
		@else
			<a class="btn btn-danger text-white" href="#">
				<i class="fa fa-pause"></i> {{__("Producto Eliminado")}}
			</a>
		@endif
	@endif
</div>