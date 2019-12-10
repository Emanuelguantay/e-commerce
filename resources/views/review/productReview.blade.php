@extends('layouts.app')

@section('jumbotron')
	@include('partials.review.jumbotron')
	
@endsection

@section('content')
	<div class="pl-5 pr-5">
		<div class="row justify-content-center">
			@include('partials.products.form_review')
		</div>
	</div>
@endsection