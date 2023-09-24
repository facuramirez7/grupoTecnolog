<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('device_types')->insert([
            'name' => 'Decanter'
        ]);

        DB::table('device_types')->insert([
            'name' => 'Separadora'
        ]);

        DB::table('device_types')->insert([
            'name' => 'OSD 25'
        ]);

        DB::table('device_types')->insert([
            'name' => 'OSD 20'
        ]);
    }
}
