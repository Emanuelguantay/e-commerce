@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Detalle', 'icon' => 'th-list'])
@endsection

@section('content')
	<div class="container">

    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron2.jpg') }}')">
          <div class="text-white text-center d-flex align-center py-5 px-4 my-5">
            <div class="col-8 text-left">
              <h4>{{__("Id")}}: {{$product->id}}</h4>
              <h4> {{__("Nombre")}}: {{$product->name}}</h4>
              <h4>{{__("Indumentaria")}}: {{$product->indumentaria_id}}</h4>
              <h4>{{__("Genero")}}: {{$product->genero_id}}</h4>
              <h4>{{__("Descripcion")}}: {{$product->description}}</h4>
              <h4>{{__("Precio")}}: $ {{$product->price}}</h4>
              <h4>{{__("Fecha de publicación")}}: {{$product->created_at->format('d/m/Y')}}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Agregar Talles
    </button>

    <br></br>
  <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($product->talles as $talle)
          <tr>
            <td>{{$talle->getOriginal('pivot_id')}}</td>
            <td>{{$talle->name}}</td>
            <td>{{$talle->pivot->stock}}</td>
            <td>
                <a href="#" class="btn btn-success edit"> Edit</a>
                <a href="#" class="btn btn-danger delete"> Delet</a>
                
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
     
	</div>

@endsection