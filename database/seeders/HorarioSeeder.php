<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $diasSemana = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $canchas = [1, 2, 3];

        foreach ($canchas as $cancha) {
            foreach ($diasSemana as $dia) {
                for ($i = 1; $i <= 3; $i++) {
                    switch ($i) {
                        case 1:
                            $horaInicio = '08:00:00';
                            $horaCierre = '12:00:00';
                            break;
                        case 2:
                            $horaInicio = '12:00:00';
                            $horaCierre = '16:00:00';
                            break;
                        case 3:
                            $horaInicio = '16:00:00';
                            $horaCierre = '20:00:00';
                            break;
                    }

                    DB::table('horarios')->insert([
                        'hora_inicio' => $horaInicio,
                        'hora_cierre' => $horaCierre,
                        'dia_semana' => $dia,
                        'id_cancha' => $cancha,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
