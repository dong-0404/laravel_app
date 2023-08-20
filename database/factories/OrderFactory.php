<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 3), // Assuming you have 10 customers
        'user_id' => $this->faker->numberBetween(1, 10), // Assuming you have 10 users
        'status_id' => $this->faker->numberBetween(1, 4), // Assuming you have 4 status
        'total_amount' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
