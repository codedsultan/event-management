<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use App\Models\Event;
use App\Models\vendor;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = Vendor::factory()->create([
            'name' => 'Colby',
            'email' => 'colby@workwithmarque.com',
        ]);


        $event = Event::factory()->create([
            'vendor_id' => $vendor->id
        ]);

        Event::factory(5)->create([
            'vendor_id' => $vendor->id
        ]);

        $ticket1 = Ticket::factory()->create([
            'event_id' => $event->id,
            'type' => 'silver',
        ]);

        $ticket2 = Ticket::factory()->create([
            'event_id' => $event->id,
            'type' => 'gold',
        ]);

        $ticket3 = Ticket::factory()->create([
            'event_id' => $event->id ,
            'type' => 'platinum',
        ]);

        $vendor1 = Vendor::factory()->create([
            'name' => 'Segun',
            'email' => 'segun@gmail.com',
        ]);

        ApiKey::create(
            [
                'stripe' => 'sk_test_51P2U5J2L0SD3rBoYOWHLrdMww8nsZWpGCklwVVlMwugwySnW2Pm5lSs1VrT1PoVJ4ZiCrN9pNc2Nc8Gt0dqMjuiL00IRof5Icn',
                'vendor_id' => $vendor1->id
            ]
        );

        $event1 = Event::factory()->create([
            'vendor_id' => $vendor1->id
        ]);

        Event::factory(5)->create([
            'vendor_id' => $vendor1->id
        ]);

        Ticket::factory()->create([
            'event_id' => $event1->id,
            'type' => 'silver',
        ]);

        Ticket::factory()->create([
            'event_id' => $event1->id,
            'type' => 'gold',
        ]);

        Ticket::factory()->create([
            'event_id' => $event1->id ,
            'type' => 'platinum',
        ]);

    }
}
