@extends('layout')


@section('content')

    <p>Filtro por categoria</p>
    <form >
        <select name="categoria" id="">
            <option value="">Ninguna</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ ($query == $categoria->id) ? 'selected' : ''  }} >{{ $categoria->nombre }}</option>
            @endforeach
        </select>
        <input type="submit" value="send">
    </form>
    <br />
    <br />

    <ul class="list-group">
        @foreach($productos as $producto)
            <li class="list-group-item">{{ $producto->titulo }}</li>
        @endforeach
    </ul>


    <br>
    {{ $productos->links('pagination::bootstrap-4') }}


@endsection