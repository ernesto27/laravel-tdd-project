<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Comentario;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class ProductoController extends Controller
{

    public static $pagesCount = 10;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(Request $request)
    {
        $productosFactory = Producto::orderBy('id', 'desc');

        $query = $request->get('categoria');
        if($query){
            $productosFactory->byCategoria($query);
        }

        $productos = $productosFactory->paginate(self::$pagesCount);


        if(!count($productos)) {
            throw new Exception('No productos found');
        }

        $categorias = Categoria::active()->get();
        return view('productos.index', compact('productos', 'categorias', 'query'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $comentarios = Comentario::where('producto_id', $id)->orderByRaw('COALESCE(NULLIF(parent_comment_id,0),id) desc')->get();

        return view('productos.show', compact('producto', 'comentarios'));
    }

    public function create()
    {
        $categorias = Categoria::active()->get();
        return view('productos.create', compact('categorias'));
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
        $categorias = Categoria::active()->get();
        return view('productos.edit', compact('producto', 'categorias'));
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










