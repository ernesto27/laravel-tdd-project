@extends('layout')


@section('content')

    <ul class="list-group">
        @foreach($productos as $producto)
            <li class="list-group-item">{{ $producto->titulo }}</li>
        @endforeach
    </ul>


    <br>
    {{ $productos->links('pagination::bootstrap-4') }}


@endsection