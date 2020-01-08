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
          <th scope="col">{{__("Usuario")}}</th>
          <th scope="col">{{__("Dirección")}}</th>
          <th scope="col">{{__("Total")}}</th>
          <th scope="col">{{__("Fecha")}}</th>
          <th scope="col">{{__("Estado")}}</th>
          <th scope="col">{{__("Acciones")}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $orderData)
          <tr>
            <td>{{$orderData->id}}</td>
            <td>{{$orderData->user->name}}</td>
            <td>{{$orderData->address}}</td>
            <td>{{__('Moneda')}}{{$orderData->total}}</td>
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
                <a href="#" class="btn btn-success edit"> {{__("Editar")}}</a>
                <a href="{{ route('order.detail', ['id' => $orderData->id]) }}" class="btn btn-primary edit"> {{__("Ver")}}</a>
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
        <h5 class="modal-title" id="exampleModalLabel">{{__("Orden")}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/orders" method="POST" id="editForm">
      {{csrf_field()}}
      {{method_field('PUT')}}
        <div class="modal-body">
          <input type="hidden" name="order_id" value="{{$orderData->id}}" />
            <div class="form-group">
              <label >Order Id: {{$orderData->id}}</label>
            </div>

            <div class="form-group">
              <select name="status_id" id="status_id" class="form-control">
                  <option value="{{\App\Order::PENDING}}" selected>{{__("PENDIENTE")}}</option>
                  <option value="{{\App\Order::PROCESSING}}">{{__("PROCESO")}}</option>
                  <option value="{{App\Order::FINISHED}}">{{__("FINALIZADO")}}</option>
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
      $('#status_id').val(data[1]);

      $('#editForm').attr('action','/orders/'+data[0]);
      $('#editModal').modal('show');
    });
    //end edir record



  });
</script>
  
@endsection