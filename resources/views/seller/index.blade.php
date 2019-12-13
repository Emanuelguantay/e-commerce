@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Vendedores'), 'icon' => 'edit'])
@endsection

@section('content')
	<div class="container">
    <!-- Table table-bordered -->
    <table id="datatable" class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">{{__("Nombre")}}</th>
          <th scope="col">Email</th>
          <th scope="col">{{__("Tipo de usuario")}}</th>
          <th scope="col">{{__("Acciones")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sellers as $sellerData)
          <tr>
            <td>{{$sellerData->id}}</td>
            <td>{{$sellerData->name}}</td>
            <td>{{$sellerData->email}}</td>
            <td>{{$sellerData->role->name}}</td>
            <td>
                <a href="#" class="btn btn-success edit"> {{__("Editar")}}  </a>
                <a href="#" class="btn btn-danger delete"> {{__("Eliminar")}}</a>
                
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
	</div>


<!-- Edit Add Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("Vendedor")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/seller" method="POST" id="editForm">
      {{csrf_field()}}
      {{method_field('PUT')}}
        <div class="modal-body">
          
            <div class="form-group">
              <label >{{__("Vendedor")}}: </label>
              <input type="text" name="bName" id="bName" class="form-control" placeholder="Ingrese el nombre" disabled="true">
            </div>
            <div class="form-group">
              <select name="role_id" id="role_id" class="form-control">
                  @foreach(\App\Role::pluck('name', 'id') as $id => $role)
                  {{$role}}
                      @if($role != ('admin'))
                        <option value="{{ $id }}">
                            {{$role}}
                        </option>
                      @endif
                  @endforeach
              </select>
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
        <h5 class="modal-title" id="exampleModalLabel">{{__("Vendedor")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/seller" method="POST" id="deleteForm">
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

      $('#editForm').attr('action','/seller/'+data[0]);
      $('#editModal').modal('show');
    });
    //end edir record

    table.on('click','.delete',function(){
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();
      $('#deleteForm').attr('action','/seller/'+data[0]);
      $('#deleteModal').modal('show');

    });



  });
</script>
@endsection