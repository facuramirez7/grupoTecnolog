<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('devices')->insert([
            'client_id' => 1,
            'deviceType_id' => 2,
            'model' => 'GSE 75-06-177',
            'serial_number' => '1726-308',
            'hours_lastServ' => 14827,
            'actual_hours' => 19077,
            'update_actualHours' => '2020-09-30',
            'last_visit' => '2022-10-16',
            'visit_type' => 2,
            'prox_service' => 3,
        ]);
    }
}
