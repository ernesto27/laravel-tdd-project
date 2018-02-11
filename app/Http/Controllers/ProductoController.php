<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('create');
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {

        $this->doValidate();

        $this->updateOrCreate($request);

        return back()->with('status', 'El producto se agrego correctamente');

    }


    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $this->doValidate();

        if(Auth::user()->id == $request->get('user_id')){
            $this->updateOrCreate($request, $id);
            return back()->with('status', 'El producto se edito correctamente');
        }

        abort(403, 'Unauthorized action.');

    }

    protected function updateOrCreate($request, $id = 0)
    {
        $condition = ['id' => $id ];

        return Producto::updateOrCreate($condition, [
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'precio' => $request->get('precio'),
            'cantidad' => $request->get('cantidad'),
            'categoria_id' => $request->get('categoria_id'),
            'user_id' => Auth::user()->id
        ]);
    }

    protected function doValidate()
    {
        request()->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'cantidad' => 'required|integer',
            'categoria_id' => 'required'
        ]);
    }
}










