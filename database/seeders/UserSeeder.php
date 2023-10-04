<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'facuramirezcpbm@gmail.com',
            'password' => '$2y$10$CDJlX9AQPOoXfBm3gHX6q.f70fRIoXX3lqeqUN2Qm5JmdkjF4l9sq',
            'rol_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'José',
            'email' => 'jose@grupotecnolog.com',
            'password' => '$2y$10$CDJlX9AQPOoXfBm3gHX6q.f70fRIoXX3lqeqUN2Qm5JmdkjF4l9sq',
            'rol_id' => 5,
        ]);

        DB::table('users')->insert([
            'name' => 'Pedro Perovich',
            'email' => 'pedro@grupotecnolog.com',
            'password' => '$2y$10$CDJlX9AQPOoXfBm3gHX6q.f70fRIoXX3lqeqUN2Qm5JmdkjF4l9sq',
            'rol_id' => 50,
        ]);
    }
}
