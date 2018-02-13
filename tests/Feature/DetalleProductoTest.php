<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
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
        $user = factory('App\User')->create();
        $this->signIn($user);
        $producto = factory('App\Producto')->create();
        $comentario = factory('App\Comentario')->make(['producto_id' => $producto->id, 'user_id' => $user->id]);

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

    /** @test */
    public function a_producto_owner_can_respond_to_a_comment()
    {
        $user = factory('App\User')->create();
        $this->signIn($user);

        $producto = factory('App\Producto')->create(['user_id' => $user->id]);

        $comentarioPregunta = factory('App\Comentario')->create(['producto_id' => $producto->id]);

        $respuestaComentario = factory('App\Comentario')
                            ->make(['producto_id' => $producto->id, 'user_id' => $user->id, 'parent_comment_id' => $comentarioPregunta->id]);

        $this->post('/comentarios/respuesta/{id}', $respuestaComentario->toArray());

        $this->assertDatabaseHas('comentarios' , $respuestaComentario->toArray());
    }

    /** @test */
    public function a_not_owner_producto_can_not_respond_to_answers()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $producto = factory('App\Producto')->create();

        $comentarioPregunta = factory('App\Comentario')->create(['producto_id' => $producto->id]);

        $respuestaComentario = factory('App\Comentario')
            ->make(['producto_id' => $producto->id, 'user_id' => Auth::user()->id, 'parent_comment_id' => $comentarioPregunta->id]);

        $this->post('/comentarios/respuesta/{id}', $respuestaComentario->toArray());

        $this->assertDatabaseMissing('comentarios' , $respuestaComentario->toArray());

    }
}














