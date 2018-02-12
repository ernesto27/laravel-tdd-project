<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductoController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListadoProductosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_a_list_of_productos()
    {
        $productos = factory('App\Producto', ProductoController::$pagesCount)->create(['user_id' => 1]);

        $this->get('productos')
             ->assertSeeText($productos[0]->titulo);
    }

    /** @test */
    public function it_should_filter_productos_by_categoria()
    {
        $categoria = factory('App\Categoria')->create();
        $productos = factory('App\Producto', 2)->create(['user_id' => 1, 'categoria_id' => $categoria->id]);

        $otherProductos = factory('App\Producto', 50)->create(['user_id' => 1]);

        $this->get('productos?categoria=' . $categoria->id)
             ->assertSeeText($productos[0]->titulo)
             ->assertSeeText($productos[1]->titulo)
             ->assertDontSeeText($otherProductos[0]->titulo);



    }

}