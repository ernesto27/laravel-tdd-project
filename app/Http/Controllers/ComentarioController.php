<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->doValidate($request);

        Comentario::create([
            'texto' => $request->get('texto'),
            'producto_id' => $request->get('producto_id'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->to('productos/' . $request->get('producto_id'));
    }

    public function storeRespuesta(Request $request)
    {
        $this->doValidate($request);

        if(!$this->isProductoOwner($request->get('producto_id'))){
            abort(403, 'Unauthorized action.');
        }

        Comentario::create([
            'texto' => $request->get('texto'),
            'producto_id' => $request->get('producto_id'),
            'parent_comment_id' => $request->get('parent_comment_id'),
            'user_id' => Auth::user()->id
        ]);
    }

    protected function doValidate($request)
    {
        $this->validate($request, [
            'texto' => 'required'
        ]);
    }

    protected function isProductoOwner($productoId)
    {
        $producto = Producto::where('id', $productoId)
                            ->where('user_id', Auth::user()->id)
                            ->count();
        
        if($producto){
            return true;
        }
    }

}
