@extends('layout')


@section('content')
    @include('productos.form', ['type' => 'Editar',  'method' => 'PUT'])
@endsection