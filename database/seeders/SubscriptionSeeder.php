<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        Subscription::create([
            'email' => 'subscriber1@spezia.com',
        ]);

        Subscription::create([
            'email' => 'subscriber2@spezia.com',
        ]);

        Subscription::create([
            'email' => 'subscriber3@spezia.com',
        ]);
    }
}
