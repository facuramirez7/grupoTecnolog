<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'id' => 1,
            'name' => 'Personalizado',
            'description' => 'Servicio personalizado',
            'prize' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'Puesta en marcha',
            'description' => 'Inicio de la actividad',
            'prize' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => '2500',
            'description' => 'Servicio de 2500 horas',
            'prize' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => '5000',
            'description' => 'Servicio de 5000 horas',
            'prize' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => '10000',
            'description' => 'Servicio de 10000 horas',
            'prize' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'name' => 'TyT',
            'description' => 'Tambor y Tranmisión',
            'prize' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
