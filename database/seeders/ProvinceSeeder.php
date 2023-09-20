<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $argentinaId = 1;
        $espanaId = 2;
        $provinces = [
            ['name' => 'Buenos Aires', 'country_id' => $argentinaId],
            ['name' => 'Ciudad Autónoma de Buenos Aires', 'country_id' => $argentinaId],
            ['name' => 'Catamarca', 'country_id' => $argentinaId],
            ['name' => 'Chaco', 'country_id' => $argentinaId],
            ['name' => 'Chubut', 'country_id' => $argentinaId],
            ['name' => 'Córdoba', 'country_id' => $argentinaId],
            ['name' => 'Corrientes', 'country_id' => $argentinaId],
            ['name' => 'Entre Ríos', 'country_id' => $argentinaId],
            ['name' => 'Formosa', 'country_id' => $argentinaId],
            ['name' => 'Jujuy', 'country_id' => $argentinaId],
            ['name' => 'La Pampa', 'country_id' => $argentinaId],
            ['name' => 'La Rioja', 'country_id' => $argentinaId],
            ['name' => 'Mendoza', 'country_id' => $argentinaId],
            ['name' => 'Misiones', 'country_id' => $argentinaId],
            ['name' => 'Neuquén', 'country_id' => $argentinaId],
            ['name' => 'Río Negro', 'country_id' => $argentinaId],
            ['name' => 'Salta', 'country_id' => $argentinaId],
            ['name' => 'San Juan', 'country_id' => $argentinaId],
            ['name' => 'San Luis', 'country_id' => $argentinaId],
            ['name' => 'Santa Cruz', 'country_id' => $argentinaId],
            ['name' => 'Santa Fe', 'country_id' => $argentinaId],
            ['name' => 'Santiago del Estero', 'country_id' => $argentinaId],
            ['name' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur', 'country_id' => $argentinaId],
            ['name' => 'Tucumán', 'country_id' => $argentinaId],

            ['name' => 'Álava', 'country_id' => $espanaId],
            ['name' => 'Albacete', 'country_id' => $espanaId],
            ['name' => 'Alicante', 'country_id' => $espanaId],
            ['name' => 'Almería', 'country_id' => $espanaId],
            ['name' => 'Asturias', 'country_id' => $espanaId],
            ['name' => 'Ávila', 'country_id' => $espanaId],
            ['name' => 'Badajoz', 'country_id' => $espanaId],
            ['name' => 'Barcelona', 'country_id' => $espanaId],
            ['name' => 'Burgos', 'country_id' => $espanaId],
            ['name' => 'Cáceres', 'country_id' => $espanaId],
            ['name' => 'Cádiz', 'country_id' => $espanaId],
            ['name' => 'Cantabria', 'country_id' => $espanaId],
            ['name' => 'Castellón', 'country_id' => $espanaId],
            ['name' => 'Ciudad Real', 'country_id' => $espanaId],
            ['name' => 'Córdoba', 'country_id' => $espanaId],
            ['name' => 'Cuenca', 'country_id' => $espanaId],
            ['name' => 'Girona', 'country_id' => $espanaId],
            ['name' => 'Granada', 'country_id' => $espanaId],
            ['name' => 'Guadalajara', 'country_id' => $espanaId],
            ['name' => 'Gipuzkoa', 'country_id' => $espanaId],
            ['name' => 'Huelva', 'country_id' => $espanaId],
            ['name' => 'Huesca', 'country_id' => $espanaId],
            ['name' => 'Jaén', 'country_id' => $espanaId],
            ['name' => 'La Coruña', 'country_id' => $espanaId],
            ['name' => 'La Rioja', 'country_id' => $espanaId],
            ['name' => 'Las Palmas', 'country_id' => $espanaId],
            ['name' => 'León', 'country_id' => $espanaId],
            ['name' => 'Lérida ', 'country_id' => $espanaId],
            ['name' => 'Lugo', 'country_id' => $espanaId],
            ['name' => 'Madrid', 'country_id' => $espanaId],
            ['name' => 'Málaga', 'country_id' => $espanaId],
            ['name' => 'Murcia', 'country_id' => $espanaId],
            ['name' => 'Navarra ', 'country_id' => $espanaId],
            ['name' => 'Ourense', 'country_id' => $espanaId],
            ['name' => 'Palencia', 'country_id' => $espanaId],
            ['name' => 'Pontevedra', 'country_id' => $espanaId],
            ['name' => 'Salamanca', 'country_id' => $espanaId],
            ['name' => 'Santa Cruz de Tenerife', 'country_id' => $espanaId],
            ['name' => 'Segovia', 'country_id' => $espanaId],
            ['name' => 'Sevilla', 'country_id' => $espanaId],
            ['name' => 'Soria', 'country_id' => $espanaId],
            ['name' => 'Tarragona', 'country_id' => $espanaId],
            ['name' => 'Teruel', 'country_id' => $espanaId],
            ['name' => 'Toledo', 'country_id' => $espanaId],
            ['name' => 'Valencia', 'country_id' => $espanaId],
            ['name' => 'Valladolid', 'country_id' => $espanaId],
            ['name' => 'Vizcaya ', 'country_id' => $espanaId],
            ['name' => 'Zamora', 'country_id' => $espanaId],
            ['name' => 'Zaragoza', 'country_id' => $espanaId],         
        ];

        // Inserta las provincias en la tabla "provinces"
        DB::table('provinces')->insert($provinces);
    }
}
