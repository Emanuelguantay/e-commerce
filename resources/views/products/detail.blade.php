@extends('layouts.app')

@section('jumbotron')
	@include('partials.products.jumbotron')
@endsection

@section('content')
	<div class="pl-5 pr-5">
		<div class="row justify-content-center">
			@include('partials.products.related')
			
		</div>
		
	</div>
@endsection