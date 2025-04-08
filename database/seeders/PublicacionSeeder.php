<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publicacions')->insert([
            [
                'titulo' => 'Evento en Lugar A',
                'descripcion' => 'Descripción del evento en Lugar A',
                'fechaP' => now()->addDays(1),
                'contacto' => 'contactoA@ejemplo.com',
                'nombre' => 'Lugar A',
            ],
            [
                'titulo' => 'Evento en Lugar B',
                'descripcion' => 'Descripción del evento en Lugar B',
                'fechaP' => now()->addDays(2),
                'contacto' => 'contactoB@ejemplo.com',
                'nombre' => 'Lugar B',
            ],
            [
                'titulo' => 'Evento en Lugar C',
                'descripcion' => 'Descripción del evento en Lugar C',
                'fechaP' => now()->addDays(3),
                'contacto' => 'contactoC@ejemplo.com',
                'nombre' => 'Lugar C',
            ],
            [
                'titulo' => 'Evento en Lugar D',
                'descripcion' => 'Descripción del evento en Lugar D',
                'fechaP' => now()->addDays(4),
                'contacto' => 'contactoD@ejemplo.com',
                'nombre' => 'Lugar D',
            ],
        ]);
    }
}
