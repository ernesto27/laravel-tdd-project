<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    
    public function store(Request $request)
    {

        $producto = Producto::create([
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'precio' => $request->get('precio'),
            'cantidad' => $request->get('cantidad'),
            'categoria_id' => $request->get('categoria_id'),
            'user_id' => 1
        ]);

        //var_dump($producto);
    }
}
