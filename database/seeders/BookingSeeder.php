<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = Vendor::whereEmail('segun@gmail.com')->first();
        $statuses = ['pending', 'approved', 'invoice','invoice','invoice','rejected'];
        Booking::factory()->create([
            'vendor_id' => $vendor->id,
            // 'status' => 'approved'
        ]);

        foreach($statuses as $status){
            Booking::factory()->create([
                'vendor_id' => $vendor->id,
                'status' => $status
            ]);
        }

        $vendor1 = Vendor::whereEmail('colby@workwithmarque.com')->first();
        // Vendor::factory()->create([
        //     'name' => 'Colby',
        //     'email' => 'colby@workwithmarque.com',
        // ]);

        foreach($statuses as $status){
            Booking::factory()->create([
                'vendor_id' => $vendor1->id,
                'status' => $status
            ]);
        }

        // Booking::factory()->create([
        //     'vendor_id' => $vendor->id,
        //     'status' => 'invoice'
        // ]);

        // Booking::factory()->create([
        //     'vendor_id' => $vendor->id,
        //     'status' => 'rejected'
        // ]);
    }
}
