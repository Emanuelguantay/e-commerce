<header>
	<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
		<div class="container">

			<a class="navbar-brand" href="{{url('/')}}">
				<!--Entra a carpeta config/app.php->"name" (para obtener el nombre de la aplicacion)
				{ config('app.name')}}-->
				Ecommerce
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
				<!--Left side of navbar-->
				<ul class="navbar-nav mr-auto">
					
				</ul>

				<!--Right SIde Of Navbar-->
				<ul class="navbar-nav ml-auto">

					@include('partials.navigations.'.\App\User::navigation())
					<li class="nav-item dropdown">
						<a 
							class="nav-link dropdown-toggle" 
							href="#"
							id="navbarDropdownMenuLink"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
						>
							{{__("Selecciona un idioma")}}
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a 
								class="dropdown-item" 
								href="{{route('set_language',['es'])}}"
							>
								{{__("Español")}}
							</a>
							<a 
								class="dropdown-item" 
								href="{{route('set_language',['en'])}}"
							>
								{{__("Inglés")}}
							</a>
							
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>