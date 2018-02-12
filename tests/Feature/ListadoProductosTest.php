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

}