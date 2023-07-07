<?php

namespace Database\Seeders;

use App\Models\Cancha;
use Illuminate\Database\Seeder;

class CanchaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cancha::create([
            'nombre' => 'Cancha 1',
            'lan' => 123.456789,
            'lat' => 98.7654321,
        ]);

        Cancha::create([
            'nombre' => 'Cancha 2',
            'lan' => 987.654321,
            'lat' => 12.3456789,
        ]);

        Cancha::create([
            'nombre' => 'Cancha 3',
            'lan' => 456.123789,
            'lat' => 87.6543210,
        ]);
    }
}
