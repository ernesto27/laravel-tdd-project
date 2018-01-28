<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\UserController;

class LoginUserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_login_with_valid_credentials()
    {
        $userToLogin = factory(\App\User::class)->make();
        $this->post('/register', $userToLogin->toArray());


        $this->post('/login', $userToLogin->toArray())
             ->assertSessionHas('status', UserController::$loginSuccessMessage);
    }

    /** @test  */
    public  function a_error_message_is_send_if_validation_fails()
    {

        $this->post('/login', [])
            ->assertSessionHas('status', UserController::$loginErrorMessage);
    }



}
