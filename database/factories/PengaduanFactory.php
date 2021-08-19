<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pengaduan;
use Faker\Generator as Faker;

$factory->define(Pengaduan::class, function (Faker $faker) {
    return [
        'masyarakat_id' => '1',
        'user_id' => '4',
        'judul' => $faker->sentence(2,3),
        'slug' => $faker->slug(2,3),
        'teks_pengaduan' => $faker->paragraphs(2,5),
        'foto' => 'default.jpg',
        'status' => 'terkirim',
    ];
});
