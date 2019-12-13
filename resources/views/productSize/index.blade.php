@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Talle'), 'icon' => 'edit'])
@endsection

@section('content')
	<div class="container">

    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron2.jpg') }}')">
          <div class="text-white text-center d-flex align-center py-5 px-4 my-5">
            <div class="col-4">
              <img class="img-fluid" src="{{$product->pathAttachment()}}" />
            </div>
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
      {{__("Agregar Talle")}}
    </button>

    <br></br>
  <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">{{__("Nombre")}}</th>
          <th scope="col">{{__("Cantidad")}}</th>
          <th scope="col">{{__("Acciones")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($product->talles as $talle)
          <tr>
            <td>{{$talle->getOriginal('pivot_id')}}</td>
            <td>{{$talle->name}}</td>
            <td>{{$talle->pivot->stock}}</td>
            <td>
                <a href="#" class="btn btn-success edit"> {{__("Editar")}}  </a>
                <a href="#" class="btn btn-danger delete"> {{__("Eliminar")}}</a>
                
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>


    
	</div>

<!-- Start Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("Talle")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{action('ProductSizeController@store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <input type="hidden" name="product_id" value="{{$product->id}}" />
            <div class="form-group">
              <select name="size_id" id="size_id" class="form-control">
                  @foreach(\App\Talle::pluck('name', 'id') as $id => $productsize)
                      <option value="{{ $id }}">
                          {{ $productsize }}
                      </option>
                  @endforeach
              </select>
            </div>
            
            <div class="form-group">
              <label >{{__("Cantidad")}}</label>
              <input type="number" name="stock" class="form-control" placeholder="Ingrese cantidad" min="0" max="2147483647">

            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("Cerrar")}}</button>
          <button type="submit" class="btn btn-primary">{{__("Guardar")}} </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ENd Add Modal -->



<!-- Edit Add Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("Talle")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/productsize" method="POST" id="editForm">
      {{csrf_field()}}
      {{method_field('PUT')}}
        <div class="modal-body">
          <input type="hidden" name="product_id" value="{{$product->id}}" />
            <div class="form-group">
              
              <select name="size_id" id="size_id" class="form-control">
                  @foreach(\App\Talle::pluck('name', 'id') as $id => $productsize)
                      <option value="{{ $id }}">
                          {{ $productsize }}
                      </option>
                  @endforeach
              </select>
            </div>
            
            <div class="form-group">
              <label >{{__("Cantidad")}}</label>
              <input type="number" name="stock" class="form-control" placeholder="Ingrese cantidad" min="0" max="2147483647">
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("Cerrar")}}</button>
          <button type="submit" class="btn btn-primary">{{__("Editar")}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Edit Modal -->


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("Talle")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/productsize" method="POST" id="deleteForm">
      {{csrf_field()}}
      {{method_field('DELETE')}}
        <div class="modal-body">
          <input type="hidden" name="_method" value="DELETE">
          <p> {{__("¿Esta seguro que desea eliminar?")}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("Cerrar")}}</button>
          <button type="submit" class="btn btn-primary">{{__("Borrar")}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Dete Modal -->

<script type="application/javascript">
  $(document).ready(function (){
    var table = $('#datatable').DataTable();
    //start Edit Record
    table.on('click','.edit',function(){
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();
      $('#stock').val(data[1]);
      $('#bDescription').val(data[2]);

      $('#editForm').attr('action','/productsize/'+data[0]);
      $('#editModal').modal('show');
    });
    //end edir record

    table.on('click','.delete',function(){
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();

      $('#deleteForm').attr('action','/productsize/'+data[0]);
      $('#deleteModal').modal('show');

    });



  });
</script>
    
@endsection