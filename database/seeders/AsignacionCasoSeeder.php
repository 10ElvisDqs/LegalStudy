<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AsignacionCaso;
use Illuminate\Database\Seeder;

class AsignacionCasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AsignacionCaso::factory()->count(10)->create();
    }
}
