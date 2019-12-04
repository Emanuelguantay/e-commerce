<div class="btn-group">
	
	@if((int) $product->status === \App\Product::PUBLISHED)
		<a class="btn btn-course" href="{{ route('products.detail', ["slug" => $product->slug]) }}">
			<i class="fa fa-eye"></i> {{__("Detalle")}}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('products.edit', ["slug" => $product->slug]) }}">
			<i class="fa fa-pencil"></i> {{__("Editar Producto")}}
		</a>
		@include('partials.products.btn_forms.delete')
	@elseif ((int) $product->status === \App\Product::PENDING)
		@if (auth()->user()->role_id === \App\Role::ADMIN)
			<form action="{{ route('products.aprobar', ["slug" => $product->slug]) }}" method="POST" >
				@csrf
				<a class="btn btn-primary text-white" >
					<i class="fa fa-thumbs-up"></i> {{__("Aprobar")}}
				</a>
			</form>
		@else
			<a class="btn btn-primary text-white" href="#">
				<i class="fa fa-history"></i> {{__("Curso pendiente de revisión")}}
			</a>
		@endif
		<a class="btn btn-course" href="{{ route('products.detail', ["slug" => $product->slug]) }}">
			<i class="fa fa-eye"></i> {{__("Detalle")}}
		</a>
		<a class="btn btn-warning text-white" href="{{ route('products.edit', ["slug" => $product->slug]) }}">
			<i class="fa fa-pencil"></i> {{__("Editar Producto")}}
		</a>
		@include('partials.products.btn_forms.delete')
	@else
		<a class="btn btn-danger text-white" href="#">
			<i class="fa fa-pause"></i> {{__("Producto rechazado")}}
		</a>
		@include('partials.products.btn_forms.delete')
	@endif
</div>