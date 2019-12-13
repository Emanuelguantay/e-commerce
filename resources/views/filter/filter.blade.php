<!--Start Filter-->
<div class="container-fluid bg-light ">
  <form method="GET" action="{{url('/list')}}" enctype="multipart/form-data">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-2 pt-3">
          <div class="form-group ">
            <select name="genero_id" id="genero_id" class="form-control">
              <option selected value="null">Generos</option>
              @foreach(\App\Genero::pluck('name', 'id') as $id => $genero)
                <option value="{{ $id }}">
                  {{ $genero }}
                </option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="col-md-2 pt-3">
          <div class="form-group">
            <select name="marca_id" id="marca_id" class="form-control">
              <option selected value="null">Marca</option>
              @foreach(\App\Marca::pluck('name', 'id') as $id => $marca)
                        <option value="{{ $id }}">
                            {{ $marca }}
                        </option>
                    @endforeach
            </select>
          </div>
      </div>
      <div class="col-md-2 pt-3">
          <div class="form-group">
            <select name="indumentaria_id" id="indumentaria_id" class="form-control">
              <option selected value="null">Tipo</option>
              @foreach(\App\Indumentaria::pluck('name', 'id') as $id => $tipo)
                        <option value="{{ $id }}">
                            {{ $tipo }}
                        </option>
                    @endforeach
            </select>
          </div>
      </div>
      <div class="col-md-2">
          <!--<button type="button" class="btn btn-primary btn-block">Search</button>-->
          
            <button type="submit" class="btn btn-primary btn-block">{{__("Buscar")}}</button>
            
      </div>
    </div>
  </form>
</div>

<!--End Filter-->