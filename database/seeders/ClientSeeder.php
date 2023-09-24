<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            'name' => 'Chandon',
            'country_id' => 1,
            'province_id' => 13,
            'address' => 'Km. 29, RP15',
            'email' => 'info@chandon.com.ar',
            'photo' => 'clientsSeeder/chandon.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
