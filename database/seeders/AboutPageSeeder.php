<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'description' => 'Spezia is an innovative blogging platform that connects readers and writers from around the world. Our unique world map visualization shows exactly where our readers are engaging with content, creating a truly global community.',
            'mission' => 'We believe in the power of storytelling to bridge cultures and create meaningful connections across borders.',
            'vision' => 'Founded in 2024, Spezia has grown to serve thousands of readers and writers across 50+ countries, fostering a vibrant community of storytellers and knowledge seekers.',
            'features' => [
                'Interactive world map showing reader locations',
                'Rich blog posts with multiple images and media',
                'Emoji reactions for instant engagement',
                'Community comments and discussions',
                'Advanced search and filtering capabilities',
                'Social media sharing integration',
            ],
            'stats' => [
                ['label' => 'Countries Represented', 'value' => '50+', 'color' => 'accent-purple'],
                ['label' => 'Active Readers', 'value' => '10K+', 'color' => 'accent-red'],
                ['label' => 'Published Articles', 'value' => '500+', 'color' => 'accent-seagreen'],
            ],
        ]);
    }
}
