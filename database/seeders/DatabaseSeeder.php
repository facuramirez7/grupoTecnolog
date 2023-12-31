<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolSeeder::class);
        \App\Models\User::factory(50)->create();
        $this->call(UserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(DeviceTypeSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(PartTypeSeeder::class);
        $this->call(PartSeeder::class);
    }
}
