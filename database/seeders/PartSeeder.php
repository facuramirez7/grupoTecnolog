<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parts')->insert([
            'serial_number' => '0007-3595-750',
            'part_type_id' => 29,
            'buy_prize' => 14827,
            'sell_prize' => 19077,
            'photo' => 'partSeeder/junta.jpg',
            'stock' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
