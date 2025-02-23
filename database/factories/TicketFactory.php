<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ticket_name" => fake() -> name(),
            "ticket_description" => fake() -> text(100),
            "category_id" => 14,
            "status" => "pending",
            "user_id"=> 5,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
