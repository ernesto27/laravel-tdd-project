<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

<div class="container ">


    <div class="row mt-5">
        <div class="col-12">

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

            <h2>Nuevo producto</h2>
            <form method="post" action="/producto">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Titulo</label>
                    <input  name="titulo" class="form-control">
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input  name="precio" class="form-control">
                </div>

                <div class="form-group">
                    <label>Cantidad</label>
                    <input  name="cantidad" class="form-control">
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <input  name="categoria_id" class="form-control">
                </div>




                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
