@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Detalle orden', 'icon' => 'th-list'])
@endsection

@section('content')
	<div class="container">

    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron2.jpg') }}')">
          <div class="text-white text-center d-flex align-center py-4 px-4 my-2">
            <div class="col-8 text-left">
              <h4>{{__("N° orden")}}: {{$order->id}}</h4>
              <h4> {{__("Total")}}: {{$order->total}}</h4>
              <h4>{{__("Fecha")}}: {{$order->created_at->format('d/m/Y')}}</h4>
              <h4>{{__("Dirección")}}: </h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Generar Pdf
    </button>

    <br></br>

  <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Marca</th>
          <th scope="col">Indumentaria</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Precio</th>
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
                $ {{$order_line->product_price * $order_line->qty}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>


    <hr> <p> <a href="{{route('order.pdf')}}" class="btn btn-
    sm btn-primary"> Descargar productos en PDF </a> </p>
     
	</div>

@endsection