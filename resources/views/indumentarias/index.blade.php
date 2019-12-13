@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron',[
        "title" => __("Tipos de indumentarias"),
        "icon" => "shopping-cart"
        //icon => "th"
    ])
@endsection
@section('content')
	<div class="container">
		
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      {{__("Agregar Indumentarias")}}
    </button>

    <br></br>

    <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">{{__("Nombre")}}</th>
          <th scope="col">{{__("Descripción")}}</th>
          <th scope="col">{{__("Acciones")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($clothes as $clothesData)
          <tr>
            <td>{{$clothesData->id}}</td>
            <td>{{$clothesData->name}}</td>
            <td>{{$clothesData->description}}</td>
            <td>
                <a href="#" class="btn btn-success edit"> {{__("Editar")}}  </a>
                <a href="#" class="btn btn-danger delete"> {{__("Eliminar")}}</a>
                <!--<form action="{{action('IndumentariaController@destroy', $clothesData->id)}}" method="POST">
                  {{csrf_field()}}
                  {{method_field('DELETE')}}
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" name="submit" title="Eliminar" class="btn btn-danger">
                        Delet
                  </button>
                </form>-->
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
	</div>

	
<!-- Start Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("Indumentaria")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{action('IndumentariaController@store')}}" method="POST">
      @csrf
        <div class="modal-body">
          
            <div class="form-group">
              <label >{{__("Nombre")}}</label>
              <input type="text" name="bName" class="form-control" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group">
              <label>{{__("Descripción")}}</label>
              <textarea class="form-control" name="bDescription" rows="3"></textarea>

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
        <h5 class="modal-title" id="exampleModalLabel">{{__("Indumentaria")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/indumentaria" method="POST" id="editForm">
      {{csrf_field()}}
      {{method_field('PUT')}}
        <div class="modal-body">
          
            <div class="form-group">
              <label >{{__("Nombre")}}</label>
              <input type="text" name="bName" id="bName" class="form-control" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group">
              <label>{{__("Descripción")}}</label>
              <textarea class="form-control" name="bDescription" id="bDescription" rows="3"></textarea>

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
        <h5 class="modal-title" id="exampleModalLabel">{{__("Indumentaria")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/indumentaria" method="POST" id="deleteForm">
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
      console.log('1');
      $('#bName').val(data[1]);
      $('#bDescription').val(data[2]);

      $('#editForm').attr('action','/indumentaria/'+data[0]);
      $('#editModal').modal('show');
    });
    //end edir record

    table.on('click','.delete',function(){
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();

      $('#deleteForm').attr('action','/indumentaria/'+data[0]);
      $('#deleteModal').modal('show');

    });



  });
</script>
    
@endsection