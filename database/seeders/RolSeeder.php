<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([
            'name' => 'Súper Administrador',
            'description' => 'Administrador del sistema',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols')->insert([
            'id' => 100,
            'name' => 'Recién llegado',
            'description' => 'Usuario que se acaba de crear la cuenta',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
