<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         * Define as regras de criação dos dados em massa
         */
        return [
            'nome' => fake()->name(),
            'site' => fake()->domainName(),
            'uf' => fake()->regionAbbr(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}