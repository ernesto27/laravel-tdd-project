@if(session('status'))
    <p class="alert alert-success">{{ session('status') }}</p>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2>{{ $type }} producto</h2>
<form method="post" action="/producto{{ (isset($producto)) ? '/' . $producto->id : '' }}">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="{{ (isset($method)) ? $method : 'POST' }}">
    <input name="user_id" type="hidden" value="{{ (isset($producto)) ? $producto->user_id : '' }}">

    <div class="form-group">
        <label>Titulo</label>
        <input  name="titulo" class="form-control" value="{{ (isset($producto)) ? $producto->titulo : old('titulo') }}">
    </div>

    <div class="form-group">
        <label>Descripcion</label>
        <textarea name="descripcion" class="form-control">{{ (isset($producto)) ? $producto->descripcion : old('descripcion') }}</textarea>
    </div>

    <div class="form-group">
        <label>Precio</label>
        <input  name="precio" class="form-control" value="{{ (isset($producto)) ? $producto->precio : old('precio') }}">
    </div>

    <div class="form-group">
        <label>Cantidad</label>
        <input  name="cantidad" class="form-control" value="{{ (isset($producto)) ? $producto->cantidad : old('cantidad') }}">
    </div>

    <div class="form-group">
        <label>Categoria</label> <br>
        <select name="categoria_id" id="">
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                        {{ (isset($producto) and $producto->categoria_id == $categoria->id
                            or (old('categoria_id') == $categoria->id))
                            ? 'selected'
                            : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
