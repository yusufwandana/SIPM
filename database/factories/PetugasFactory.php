<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Petugas;
use Faker\Generator as Faker;

$factory->define(Petugas::class, function (Faker $faker) {
    return [
        'nama'    => $faker->unique()->name,
        'jk'      => 'l',
        'no_telp' => str_replace(' ', '', $faker->unique()->e164PhoneNumber()),
        'alamat'  => $faker->streetAddress(),
        'user_id' => $faker->unique()->numberBetween(7,11),
    ];
});
