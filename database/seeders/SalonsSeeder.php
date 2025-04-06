<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salons')->insert([
            [
                'nombre' => 'Lugar A',
                'direccion' => 'C. Tepozteco 16, San Isidro, 62570 Jiutepec, Mor.',
                'precio' => 100.50,
                'capacidad' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lugar B',
                'direccion' => 'Lirio 16, Vicente Guerrero, 62570 Jiutepec, Mor.',
                'precio' => 200.75,
                'capacidad' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lugar C',
                'direccion' => 'Calle ojo de agua #34, Col. Deportiva, Tejalpa, Jiutepec Calle ojo de agua #36, Col. Deportiva, Tejalpa, 62570 Jiutepec, Mor.',
                'precio' => 300.00,
                'capacidad' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lugar D',
                'direccion' => 'Cam. Real de Yautepec, Paraiso, 62573 Jiutepec, Mor.',
                'precio' => 400.60,
                'capacidad' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lugar E',
                'direccion' => 'Calle Miguel Hidalgo 17, Tejalpa, 62570 Jiutepec, Mor.',
                'precio' => 500.00,
                'capacidad' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
