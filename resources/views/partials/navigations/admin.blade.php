<li class="nav-item">
	<a class="nav-link" href="#">{{__("Administrar pedidos")}}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="#">{{__("Administrar clientes")}}</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="#">{{__("Administrar vendedores")}}</a>
</li>
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{__("Administrar")}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('vendedor.products')}}">{{__("Productos")}}</a>
          <a class="dropdown-item" href="{{route('brand.index')}}">{{__("Marca")}}</a>
          <a class="dropdown-item" href="{{route('indumentaria.index')}}">{{__("Indumentaria")}}</a>
          <a class="dropdown-item" href="{{route('size.index')}}">{{__("Talles")}}</a>
          <a class="dropdown-item" href="{{route('gender.index')}}">{{__("Genero")}}</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('products.create')}}">{{__("Crear Producto")}}</a>
        </div>
      </li>

@include('partials.navigations.logged')