<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            "Administración de empresas" => 9,
            "Contaduría Pública" => 9,
            "Ingeniería Informática" => 9,
            "Diseño Visual" => 9,
            "Seguridad y Salud en el trabajo" => 9,
            "Tecnología en Gestión de la seguridad y salud en el trabajo" => 4,
            "Tecnología en decoración de interiores" => 4,
            "Itaunar" => 4
        ];

        foreach ($programs as $programName => $duration) {
            DB::table('programs')->insert([
                'nombre' => $programName,
                'duración' => $duration
            ]);
        }
    }
}
