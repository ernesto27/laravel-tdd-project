<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->doValidate();

        $this->updateOrCreate($request);

    }

    public function update(Request $request, $id)
    {
        $this->doValidate();

        if(Auth::user()->id == $request->get('user_id')){
            return $this->updateOrCreate($request, $id);
        }

        abort(403, 'Unauthorized action.');

    }

    protected function updateOrCreate($request, $id = null)
    {
        $condition = ($id) ? ['id' => $id ] : [];

        return Producto::updateOrCreate($condition, [
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'precio' => $request->get('precio'),
            'cantidad' => $request->get('cantidad'),
            'categoria_id' => $request->get('categoria_id'),
            'user_id' => 1
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










