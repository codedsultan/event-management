<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'number' => ''
            'vendor_id' => Vendor::factory() ?? Vendor::inRandomOrder()->first()->id,
            'booking_id' => Booking::factory() ?? Booking::inRandomOrder()->first()->id,

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Invoice $invoice) {

            InvoiceItem::factory()->create([
                'invoice_id' => $invoice->id,
            ]);

            InvoiceItem::factory()->create([
                'invoice_id' => $invoice->id,
            ]);

            InvoiceItem::factory()->create([
                'invoice_id' => $invoice->id,
            ]);

            InvoiceItem::factory()->create([
                'invoice_id' => $invoice->id,
            ]);


        });
    }
}
