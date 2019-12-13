<form action="{{route('products.destroy',['slug' => $product->slug])}}" method="POST">
	@csrf
	@method('DELETE')
	<button type="submit" class="btn btn-danger text-white">
		<i class="fa fa-trash"></i> {{__("Eliminar")}}
	</button>
	
</form>