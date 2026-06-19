<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Reaction;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Exploring the Mountains of Nepal',
                'excerpt' => 'A journey through the breathtaking Himalayan peaks and the vibrant culture of Nepal.',
                'content' => 'Nepal is a country of incredible natural beauty and rich cultural heritage. From the snow-capped peaks of the Himalayas to the bustling streets of Kathmandu, every corner tells a story. This article explores the hidden gems and popular destinations that make Nepal a must-visit destination for travelers.',
                'category' => 'travel',
                'author_name' => 'Sarah Chen',
                'author_initial' => 'S',
                'published_date' => '2024-01-15',
                'tags' => ['travel', 'mountains', 'adventure', 'asia'],
                'images' => ['images/mou1.jpeg', 'images/mou2.jpeg', 'images/mou3.jpeg'],
                'social_links' => [
                    'twitter' => 'https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(window.location.origin + url)}',
                    'facebook' => 'https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.origin + url)}',
                    'instagram' => 'https://instagram.com',
                ],
            ],
            [
                'title' => 'Digital Nomad Life: Working from Bali',
                'excerpt' => 'Discover the digital nomad lifestyle and how to work remotely from paradise.',
                'content' => 'Bali has become a hub for digital nomads seeking the perfect blend of work and leisure. With affordable living costs, excellent internet connectivity, and a vibrant community, Bali offers everything a remote worker needs. Learn about the best coworking spaces, accommodation options, and lifestyle tips for thriving as a digital nomad.',
                'category' => 'lifestyle',
                'author_name' => 'Marcus Johnson',
                'author_initial' => 'M',
                'published_date' => '2024-01-12',
                'tags' => ['lifestyle', 'nomad', 'work', 'bali'],
                'images' => ['images/glacier1.jpeg', 'images/glacier2.jpeg', 'images/glacier3.jpeg'],
                'social_links' => [
                    'twitter' => 'https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(window.location.origin + url)}',
                    'facebook' => 'https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.origin + url)}',
                    'instagram' => 'https://instagram.com',
                ],
            ],
            [
                'title' => 'Street Food Adventures in Bangkok',
                'excerpt' => 'Taste the authentic flavors of Bangkok\'s vibrant street food scene.',
                'content' => 'Bangkok\'s street food scene is legendary among food enthusiasts. From pad thai to mango sticky rice, the city offers an incredible array of culinary delights. Explore the best night markets, street vendors, and hidden food gems that make Bangkok a paradise for food lovers.',
                'category' => 'food',
                'author_name' => 'Emma Rodriguez',
                'author_initial' => 'E',
                'published_date' => '2024-01-10',
                'tags' => ['food', 'street-food', 'thailand', 'culinary'],
                'images' => ['images/str1.jpeg', 'images/str2.jpeg', 'images/str3.jpeg'],
                'social_links' => [
                    'twitter' => 'https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(window.location.origin + url)}',
                    'facebook' => 'https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.origin + url)}',
                    'instagram' => 'https://instagram.com',
                ],
            ],
            [
                'title' => 'Northern Lights: Chasing Aurora in Iceland',
                'excerpt' => 'Experience the magical Northern Lights and the natural wonders of Iceland.',
                'content' => 'Iceland is one of the best places on Earth to witness the Northern Lights. This guide covers the best time to visit, where to go, and tips for photographing this natural phenomenon. Discover the unique landscapes and culture that make Iceland truly special.',
                'category' => 'nature',
                'author_name' => 'David Thompson',
                'author_initial' => 'D',
                'published_date' => '2024-01-08',
                'tags' => ['nature', 'northern-lights', 'iceland', 'photography'],
                'images' => ['images/beach1.jpeg', 'images/beach2.jpeg', 'images/beach3.jpeg'],
                'social_links' => [
                    'twitter' => 'https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(window.location.origin + url)}',
                    'facebook' => 'https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.origin + url)}',
                    'instagram' => 'https://instagram.com',
                ],
            ],
        ];

        foreach ($blogs as $blog) {
            $createdBlog = Blog::create($blog);

            $emojis = ['❤️', '👍', '😍', '🔥', '💯'];
            foreach ($emojis as $emoji) {
                Reaction::create([
                    'blog_id' => $createdBlog->id,
                    'emoji' => $emoji,
                    'count' => 0,
                ]);
            }
        }
    }
}
