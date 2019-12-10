@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron',[
        "title" => __("Accede a cualquier indumentaria"),
        "icon" => "shopping-cart"
        //icon => "th"
    ])
    @include('filter.filter')
@endsection

@section('content')

<div class="pl-5 pr-5">
    <div class="row justify-content-center">
        
        @forelse($products as $product)
            @if($product->talles_count > 0)
                <div class="col-md-3">
                    
                    @include('partials.products.card_product')
                    
                </div>
            @endif
        @empty
            <div class="alert alert-dark">
                {{__("No hay ningúna indumentaria disponible")}}
            </div>
        @endforelse
    </div>
    <div class="row justify-content-center">
        {{ $products->links() }}
    </div>
    <input type="hidden" name="product_ide" value="15" />
</div>
@endsection