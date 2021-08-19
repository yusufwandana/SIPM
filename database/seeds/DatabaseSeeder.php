<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Petugas;
use App\Masyarakat;
use App\Pengaduan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama'      =>  'Akun Demo',
            'email'     =>  'demo@gmail.com',
            'password'  =>  bcrypt  ('demo'),
            'role'      =>  'admin'
        ]);

        factory(User::class, 10)->create();
        factory(Petugas::class, 5)->create();
        factory(Masyarakat::class, 5)->create();
        factory(Pengaduan::class, 5)->create();
    }
}
