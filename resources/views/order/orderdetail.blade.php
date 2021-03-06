@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Detalle orden'), 'icon' => 'th-list'])
@endsection

@section('content')
	<div class="container">

    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron2.jpg') }}')">
          <div class="text-white text-center d-flex align-center py-4 px-4 my-2">
            <div class="col-8 text-left">
              <h4>{{__("N° orden")}}: {{$order->id}}</h4>
              <h4> {{__("Total")}}: {{__("Moneda")}}{{$order->total}}</h4>
              @if($order->created_at)
                <h4>{{__("Fecha")}}: {{$order->created_at->format('d/m/Y')}}</h4>
              @endif
              <h4>{{__("Dirección")}}: {{$order->address}}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br></br>
  
  <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">{{__("Nombre")}}</th>
          <th scope="col">{{__("Marca")}}</th>
          <th scope="col">{{__("Indumentaria")}}</th>
          <th scope="col">{{__("Cantidad")}}</th>
          <th scope="col">{{__("Precio por cantidad")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->order_Lines as $order_line)
          <tr>
            <td>{{$order_line->id}}</td>
            <td>{{$order_line->productTalle->product->name}}</td>
            <td>{{$order_line->marca}}</td>
            <td>{{$order_line->indumentaria}}</td>
            <td>{{$order_line->qty}}</td>
            <td>
                {{__("Moneda")}}{{$order_line->product_price * $order_line->qty}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
	</div>
@endsection