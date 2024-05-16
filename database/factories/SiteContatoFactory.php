<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteContato>
 */
class SiteContatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'telefone' => fake()->cellphoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'motivo_contato' => fake()->numberBetween(1, 3),
            'mensagem' => fake()->text()
        ];
    }
}