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

        $this->signIn();
        $producto = factory(\App\Producto::class)->make();
        $productoArray = $producto->toArray();

        $this->post('/producto', $productoArray);
        $this->assertDatabaseHas('productos', $productoArray);

    }

    /** @test */
    public function a_login_user_can_not_add_a_producto_given_invalid_data()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $productoArray = [];

        $this->post('/producto', $productoArray);
        $this->assertDatabaseMissing('productos', $productoArray);

    }

    /** @test */
    public function a_login_user_can_edit_his_product()
    {
        $this->signIn();

        $originalProducto = factory(\App\Producto::class)->create(['user_id' => 1]);
        $newProducto = factory(\App\Producto::class)->make(['user_id' => 1]);

        $newProductoArray = $newProducto->toArray();
        $this->put('/producto/' . $originalProducto->toArray()['id'], $newProductoArray);

        $this->assertDatabaseHas('productos', $newProductoArray);
    }

    /** @test */
    public function a_login_user_can_not_edit_a_product_if_is_not_owner()
    {

        $this->signIn();

        $originalProducto = factory(\App\Producto::class)->create(['user_id' => 2]);
        $newProducto = factory(\App\Producto::class)->make(['user_id' => 2]);

        $this->expectExceptionMessage('Unauthorized action.');
        $newProductoArray = $newProducto->toArray();
        $this->put('/producto/' . $originalProducto->toArray()['id'], $newProductoArray);


    }

}
















