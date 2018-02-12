<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetalleProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_detail_of_a_product()
    {
        $producto = factory('App\Producto')->create(['user_id' => 1]);
        $this->get('/productos/' . $producto->id)
             ->assertSeeText($producto->titulo)
             ->assertSeeText($producto->descripcion);
    }

    /** @test */
    public function a_login_user_can_comment_a_producto()
    {
        $this->signIn();
        $producto = factory('App\Producto')->create(['user_id' => 1]);
        $comentario = factory('App\Comentario')->make(['producto_id' => $producto->id]);

        $this->post('/comentarios/productos/' . $producto->id, $comentario->toArray())
             ->assertRedirect('/productos/' . $producto->id);

        $this->assertDatabaseHas('comentarios', $comentario->toArray());

        $this->get('/productos/' . $producto->id)
             ->assertSeeText($comentario->texto);
    }

    /** @test */
    public function a_comment_must_have_a_texto()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $producto = factory('App\Producto')->create(['user_id' => 1]);
        $comentario = factory('App\Comentario')->make(['producto_id' => $producto->id, 'texto' => '']);

        $this->post('/comentarios/productos/' . $producto->id, $comentario->toArray());

        $this->assertDatabaseMissing('comentarios', $comentario->toArray());
    }
}
