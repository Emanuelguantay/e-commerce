<h1 class="page-header">Orden</h1>
<table class="table table-hover
table-striped">
<thead>
<tr>
<th>ID</th>
<th>Producto</th>
<th>Descripción</th>
<th>Stock</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
<td>{{ $order->id }}</td>
<td></td>
<td></td>
<td class="text-right"></td>
</tr>
@endforeach
</tbody>
</table>