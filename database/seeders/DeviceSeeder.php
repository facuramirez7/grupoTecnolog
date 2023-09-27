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
            'service_id' => 2,
            'prox_service' => 3,
            'photo' => 'deviceSeeder/maquina.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('devices')->insert([
            'client_id' => 1,
            'deviceType_id' => 2,
            'model' => ' GSC 45-36-177',
            'serial_number' => '1725-253',
            'hours_lastServ' => 448,
            'actual_hours' => 650,
            'update_actualHours' => '2020-09-30',
            'last_visit' => '2022-10-16',
            'service_id' => 2,
            'prox_service' => 3,
            'photo' => 'deviceSeeder/maquina2.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('devices')->insert([
            'client_id' => 2,
            'deviceType_id' => 1,
            'model' => 'CA 501-01-02',
            'serial_number' => '8004-247',
            'hours_lastServ' => 489,
            'actual_hours' => 1542,
            'update_actualHours' => '2020-09-30',
            'last_visit' => '2022-10-16',
            'service_id' => 2,
            'prox_service' => 3,
            'active' => 0,
            'photo' => 'deviceSeeder/decanter.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
