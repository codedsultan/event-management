<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory() ?? Invoice::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'price' => rand(10,500),
            'description' => fake()->paragraph()
            // $table->integer('quantity')->default(1);
        ];
    }
}
