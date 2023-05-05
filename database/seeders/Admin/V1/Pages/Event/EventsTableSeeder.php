<?php

namespace Database\Seeders\Admin\V1\Pages\Event;

use App\Models\Admin\V1\Pages\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::truncate();

        $events = [
            [
                'id' => '1',
                'user_id' => '1',
                'name' => 'Lunch',
                'color' => '#28a745',
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'name' => 'Go home',
                'color' => '#ffc107',
            ],
            [
                'id' => '3',
                'user_id' => '1',
                'name' => 'Do homework',
                'color' => '#17a2b8',
            ],
            [
                'id' => '4',
                'user_id' => '1',
                'name' => 'Work on UI design',
                'color' => '#007bff',
            ],
            [
                'id' => '5',
                'user_id' => '1',
                'name' => 'Sleep tight',
                'color' => '#dc3545',
            ],
        ];
        Event::insert($events);
    }
}
