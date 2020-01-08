<!DOCTYPE html>
<html>
<head>
<style>
#ranking {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#ranking td, #ranking th {
  border: 1px solid #ddd;
  padding: 8px;
}

#ranking tr:nth-child(even){background-color: #f2f2f2;}

#ranking tr:hover {background-color: #ddd;}

#ranking th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4dc0b5;
  color: white;
}
#title{
	text-align:center;
	}
}
</style>
</head>
<body>
<h1 class="page-header" id ="title"> Generos</h1>
	
	<table id="ranking" class="table table-hover
	table-striped">
	<thead>
	<tr>
	<th>Genero_id</th>
	<th>Nombre de genero</th>
	<th>Cantidad </th>
	</tr>
	</thead>
	<tbody>
	@foreach($generos as $genero)
	<tr>
	<td>{{ $genero->id}}</td>
	<td>{{$genero->name}}</td>
	<td>{{ $genero->count}}</td>
	</tr>
	@endforeach
	</tbody>
	</table>
</body>
</html>