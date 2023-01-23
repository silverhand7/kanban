<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $column = Column::inRandomOrder()->first();
        $max = Card::where('column_id', $column->id)->count();
        $order = ($max == 0) ? 0 : ($max + 1) - 1;
        return [
            'column_id' => $column->id,
            'title' => fake()->words(rand(2, 6), true),
            'description' => fake()->words(rand(0, 20), true),
            'order' => $order,
        ];
    }
}
