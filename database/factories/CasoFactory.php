<?php

namespace Database\Factories;
use App\Models\Caso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caso>
 */
class CasoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Caso::class;
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'fecha_apertura' => $this->faker->date,
            'estado' => $this->faker->randomElement(['Abierto', 'Cerrado']),
            'id_tipo' => $this->faker->numberBetween(3, 9), // Números entre 3 y 9 según tus tipos.
            'id_cliente' => \App\Models\Client::factory(), // Crea clientes utilizando el factory de clientes.
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
