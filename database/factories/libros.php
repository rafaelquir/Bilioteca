<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'titulo' => $faker ->titulo,
        'sinopsis' => $faker ->sinopsis,
        'genero' => $faker ->genero,
        'nombreAutor' => $faker ->nombreAutor,
    ];
});
