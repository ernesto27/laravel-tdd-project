@extends('layout')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $producto->titulo }}</h3>
            <p class="card-text">{{ $producto->descripcion }}}</p>
        </div>
    </div>

    <div class="card p-3">
        <h2>Comentarios</h2>


        <ul>
            @foreach($comentarios as $comentario)
                <li>{{ $comentario->texto }}</li>
            @endforeach
        </ul>

    </div>
@endsection
