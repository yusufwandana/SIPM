<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Masyarakat;
use Faker\Generator as Faker;

$factory->define(Masyarakat::class, function (Faker $faker) {
    return [
        'nik'     => $faker->nik(),
        'nama'    => $faker->unique()->name,
        'jk'      => 'l',
        'no_telp' => str_replace(' ', '', $faker->unique()->e164PhoneNumber()),
        'alamat'  => $faker->streetAddress(),
        'user_id' => $faker->unique()->numberBetween(2,6),
    ];
});
