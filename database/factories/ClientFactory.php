<?php

namespace Database\Factories;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'apellido' => $this->faker->lastName,
            'nombre' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
