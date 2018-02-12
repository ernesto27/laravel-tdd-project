<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Producto::class, function (Faker $faker){
    return [
        'titulo' => $faker->sentence,
        'descripcion' => $faker->text,
        'precio' => $faker->numberBetween(1, 200),
        'cantidad' => $faker->numberBetween(1, 200),
        'categoria_id' => function () {
            return factory('App\Categoria')->create()->id;
        }
    ];
});


$factory->define(App\Categoria::class, function (Faker $faker){
    return [
        'nombre' => $faker->word
    ];
});
