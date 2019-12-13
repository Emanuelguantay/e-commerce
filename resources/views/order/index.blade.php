@extends('layouts.app')

@section('jumbotron')
	@include('partials.jumbotron',['title'=> __('Ordenes'), 'icon'=> 'th-list'])
@endsection

@section('content')
	
	<div class="container">
		
    <br></br>

    <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Total</th>
          <th scope="col">{{__("Fecha")}}</th>
          <th scope="col">{{__("Acciones")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $orderData)
          <tr>
            <td>{{$orderData->id}}</td>
            <td>{{$orderData->total}}</td>
            <td>
              @if($orderData->created_at)
                {{$orderData->created_at->format('d/m/Y')}}
              @endif
            </td>
            <td>
                <!--<a href="{{action('OrderController@show', $orderData->id)}}" class="btn btn-success edit"> Ver</a>-->
                <a href="{{ route('order.detail', ['id' => $orderData->id]) }}" class="btn btn-success edit"> {{__("Ver")}}</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
	</div>
	
@endsection