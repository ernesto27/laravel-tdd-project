<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\UserController;

class RegisterUserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_register_a_new_account()
    {
        $userToRegister = factory(\App\User::class)->make();
        // Go to url
        $this->post('/register', $userToRegister->toArray())
             ->assertSessionHas('status', UserController::$registerSuccessMessage); 

    }

    /** @test */
    public function a_users_registration_fails_if_data_is_not_valid()
    {
        $this->withExceptionHandling();
        $this->post('/register', [])
             ->assertSee(UserController::$registerErrorMessage);
    }

}
