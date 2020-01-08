@extends('layouts.app')

@section('jumbotron')
	@include('partials.jumbotron',['title'=> __('Ordenes'), 'icon'=> 'th-list'])
@endsection

@section('content')
	
	<div class="container">
      @if($orders->count()!=0)
      <br></br>
      
      <!-- Table table-bordered -->
      <table id="datatable" class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">{{__("Moneda")}}Total</th>
            <th scope="col">{{__("Fecha")}}</th>
            <th scope="col">{{__("Estado")}}</th>
            <th scope="col">{{__("Acciones")}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $orderData)
            <tr>
              <td>{{$orderData->id}}</td>
              <td>{{__("Moneda")}}{{$orderData->total}}</td>
              <td>
                @if($orderData->created_at)
                  {{$orderData->created_at->format('d/m/Y')}}
                @endif
              </td>
              <td>
                @if((int) $orderData->status === (\App\Order::PENDING))
                  <a class="btn btn-danger text-white" href="#">
                   {{__("PENDIENTE")}}
                  </a>
                @elseif((int) $orderData->status === (\App\Order::PROCESSING))
                  <a class="btn btn-warning text-white" href="#">
                    {{__("PROCESO")}}
                  </a>
                @else
                  <a class="btn btn-success text-white" href="#">
                   {{__("FINALIZADO")}}
                  </a>
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
      @else
      <div class="alert alert-dark text-center">
                    {{__("Aun no tienes pedidos disponible")}}
        </div>
        <div class="text-center">
          <a class="btn btn-subscribe btn-bottom " href="{{route('home')}}">
          <i class="fa fa-shopping-cart"></i> {{__("Continuar comprando")}}
        </a>
        </div>
      @endif
    
	</div>
	
@endsection