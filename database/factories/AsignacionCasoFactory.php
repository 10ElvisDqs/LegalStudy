<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AsignacionCaso;
use App\Models\Caso; // Asegúrate de tener esta línea
use App\Models\User; // Asegúrate de tener esta línea

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsignacionCaso>
 */
class AsignacionCasoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_caso' => Caso::inRandomOrder()->first()->id,
            'id_abogado' => User::inRandomOrder()->first()->id,
            'fecha_asignacion' => $this->faker->date,
            'fecha_desasignacion' => $this->faker->optional()->date,
            'rol_en_caso' => $this->faker->optional()->word,
            'estado' => $this->faker->randomElement(['activo', 'inactivo', 'completado']),
            'horas_trabajadas' => $this->faker->optional()->randomFloat(2, 0, 8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
