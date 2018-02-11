<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_login_user_can_add_a_producto()
    {

        $producto = factory(\App\Producto::class)->make();
        $productoArray = $producto->toArray();

        $this->post('/producto', $productoArray);
        $this->assertDatabaseHas('productos', $productoArray);


    }
}