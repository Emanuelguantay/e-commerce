@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Talles', 'icon' => 'edit'])
@endsection

@section('content')
	<div class="container">
		
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
          <th scope="col">Description</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sizes as $sizeData)
          <tr>
            <td>{{$sizeData->id}}</td>
            <td>{{$sizeData->name}}</td>
            <td>{{$sizeData->description}}</td>
            <td>
                <a href="#" class="btn btn-success edit"> Edit</a>
                <a href="#" class="btn btn-danger delete"> Delet</a>
                
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
        <h5 class="modal-title" id="exampleModalLabel">Size</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{action('SizeController@store')}}" method="POST">
      @csrf
        <div class="modal-body">
          
            <div class="form-group">
              <label >Nombre</label>
              <input type="text" name="bName" class="form-control" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea class="form-control" name="bDescription" rows="3"></textarea>

            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Size</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/size" method="POST" id="editForm">
      {{csrf_field()}}
      {{method_field('PUT')}}
        <div class="modal-body">
          
            <div class="form-group">
              <label >Nombre</label>
              <input type="text" name="bName" id="bName" class="form-control" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group">
              <label>Descripción</label>
              <textarea class="form-control" name="bDescription" id="bDescription" rows="3"></textarea>

            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Size</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/size" method="POST" id="deleteForm">
      {{csrf_field()}}
      {{method_field('DELETE')}}
        <div class="modal-body">
          <input type="hidden" name="_method" value="DELETE">
          <p> ¿Esta seguro que desea eliminar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Borrar</button>
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

      $('#editForm').attr('action','/size/'+data[0]);
      $('#editModal').modal('show');
    });
    //end edir record

    table.on('click','.delete',function(){
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();

      $('#deleteForm').attr('action','/size/'+data[0]);
      $('#deleteModal').modal('show');

    });



  });
</script>
    
@endsection