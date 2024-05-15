<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'segun@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'colby@workwithmarque.com',
        ]);

        Location::factory()->create([
            'name' => 'Smoke Box',
            'description' => "We need to start advertising on social media quick-win we don't need to boil the ocean here optics deploy, yet but what's the real problem we're trying to solve here?. Let's circle back tomorrow it's a simple lift and shift job pig in a python let's pressure test this it's a simple lift and shift job we need to get all stakeholders up to speed and in the right place We need to start advertising on social media quick-win we don't need to boil the ocean here optics deploy, yet but what's the real problem we're trying to solve here?. Let's circle back tomorrow it's a simple lift and shift job pig in a python let's pressure test this it's a simple lift and shift job we need to get all stakeholders up to speed and in the right place"
        ]);
        $this->call([
            // EventSeeder::class,
            CustomerSeeder::class,
            OrganiserSeeder::class,
            VendorSeeder::class,
            BookingSeeder::class

        ]);

    }
}
