<?php

namespace App\Http\Controllers;

use App\Comentario;
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
        Comentario::create([
            'texto' => $request->get('texto'),
            'producto_id' => $request->get('producto_id'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->to('productos/' . $request->get('producto_id'));
    }

}
