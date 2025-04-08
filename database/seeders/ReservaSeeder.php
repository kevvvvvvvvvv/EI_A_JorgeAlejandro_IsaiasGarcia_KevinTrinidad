<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservas')->insert([
            [
                'fechaR' => '2025-04-05',  // Usa el formato YYYY-MM-DD directamente
                'estado' => 'pendiente',
                'correo' => 'kevinyahirt@gmail.com',
                'nombre' => 'Lugar A',
            ],
            [
                'fechaR' => '2025-04-01',
                'estado' => 'confirmado',
                'correo' => 'kevinyahirt@gmail.com',
                'nombre' => 'Lugar A',
            ],
            [
                'fechaR' => '2025-03-28',
                'estado' => 'cancelado',
                'correo' => 'kevinyahirt@gmail.com',
                'nombre' => 'Lugar A',
            ],
            [
                'fechaR' => '2025-03-15',
                'estado' => 'pendiente',
                'correo' => 'kevinyahirt@gmail.com',
                'nombre' => 'Lugar B',
            ],
            [
                'fechaR' => '2025-04-03',
                'estado' => 'confirmado',
                'correo' => 'kevinyahirt@gmail.com',
                'nombre' => 'Lugar B',
            ],
        ]);
    }
}
