@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Dar de alta un nuevo producto', 'icon' => 'edit'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <form
            method="POST"
            action="{{ ! $product->id ? route('products.store') : route('products.update', ['slug' => $product->slug])}}"
            novalidate
            enctype="multipart/form-data"
        >
            @if($product->id)
                @method('PUT')
            @endif

            @csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __("Información del producto") }}
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Nombre del producto") }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        name="name"
                                        id="name"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        value="{{ old('name') ?: $product->name }}"
                                        required
                                        autofocus
                                    />

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="marca_id"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __("Marca del producto") }}
                                </label>
                                <div class="col-md-6">
                                    <select name="marca_id" id="marca_id" class="form-control">
                                        @foreach(\App\Marca::pluck('name', 'id') as $id => $marca)
                                            <option {{ (int) old('marca_id') === $id || $product->marca_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                                {{ $marca }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="indumentaria_id" class="col-md-4 col-form-label text-md-right">{{ __("Tipo de indumentaria") }}</label>
                            <div class="col-md-6">
                                <select name="indumentaria_id" id="indumentaria_id" class="form-control">
                                    @foreach(\App\Indumentaria::groupBy('name','id')->pluck('name', 'id') as $id => $indumentaria)
                                        <option {{ (int) old('indumentaria_id') === $id || $product->indumentaria_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                            {{ $indumentaria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genero_id" class="col-md-4 col-form-label text-md-right">{{ __("Genero") }}</label>
                            <div class="col-md-6">
                                <select name="genero_id" id="genero_id" class="form-control">
                                    @foreach(\App\Genero::groupBy('name','id')->pluck('name', 'id') as $id => $genero)
                                        <option {{ (int) old('genero_id') === $id || $product->genero_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                            {{ $genero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group ml-3 mr-2">
                            <div class="col-md-6 offset-4">
                                <input
                                    type="file"
                                    class="custom-file-input{{ $errors->has('picture') ? ' is-invalid' : ''}}"
                                    id="picture"
                                    name="picture"
                                />
                                <label
                                    class="custom-file-label" for="picture"
                                >
                                    {{ __("Escoge una imagen para tu producto") }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="description"
                                class="col-md-4 col-form-label text-md-right">
                                {{ __("Descripción del producto") }}
                            </label>
                            <div class="col-md-6">
                                <textarea
                                    id="description"
                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    name="description"
                                    required
                                    rows="8"
                                >{{ old('description') ?: $product->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Precio del producto") }}
                                </label>
                                <div class="col-md-6">
                                    <input
                                        type="number"
                                        name="price"
                                        min="0"
                                        id="price"
                                        class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                        value="{{ old('price') ?: $product->price }}"
                                        required
                                        autofocus
                                    />
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                    <!--...-->
                    </div>
                </div>

                

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-4">
                                    <button type="submit" name="btnName" value="btn" class="btn btn-course">
                                        {{ __($btnText) }}
                                    </button>

                                    <a class="btn btn-info" style="{{!$product->id ? "display:none": ""}}" href="{{url('productsize',$product->id)}}">
                                        {{__("Talles")}}

                                        
                                        <!--{{ route('productsize.index', ['id' => $product->id]) }}-->
                                    </a>

                                    <!--<button {{!$product->id ? "disabled": ""}} name="btnName" value="talle" class="btn btn-info">
                                        Talles
                                    </button>-->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection