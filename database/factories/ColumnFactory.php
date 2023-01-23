<?php

namespace Database\Factories;

use App\Models\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ColumnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $max = Column::count();
        $order = ($max == 0) ? 0 : ($max + 1) - 1;
        return [
            'name' => fake()->words(rand(2, 3), true),
            'order' => $order,
        ];
    }
}
