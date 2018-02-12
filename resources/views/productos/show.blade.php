@extends('layout')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $producto->titulo }}</h3>
            <p class="card-text">{{ $producto->descripcion }}}</p>
        </div>
    </div>

    <div class="card p-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/comentarios/productos/{{ $producto->id }}" method="POST" class="mb-4">
            {{ csrf_field() }}
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Preguntar</label>
                <textarea name="texto" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Agregar</button>
        </form>

        <h2>Comentarios</h2>
        <ul>
            @foreach($comentarios as $comentario)
                <li>{{ $comentario->texto }}</li>
            @endforeach
        </ul>

    </div>
@endsection
