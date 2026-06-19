<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Create tags
        $tags = [
            'mountains', 'adventure', 'asia', 'nomad', 'work', 'bali',
            'street-food', 'thailand', 'culinary', 'northern-lights',
            'iceland', 'photography', 'travel', 'lifestyle', 'food', 'nature'
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName)
            ]);
        }

        // Create posts
        $posts = [
            [
                'title' => 'Exploring the Mountains of Nepal',
                'excerpt' => 'A journey through the breathtaking Himalayan peaks and the vibrant culture of Nepal.',
                'content' => 'Full content about Nepal mountains...',
                'category' => 'travel',
                'images' => ['images/mou1.jpeg', 'images/mou2.jpeg', 'images/mou3.jpeg'],
                'author_name' => 'Sarah Chen',
                'author_initials' => 'S',
                'published_at' => now()->subDays(5),
                'tags' => ['mountains', 'adventure', 'asia', 'travel']
            ],
            [
                'title' => 'Digital Nomad Life: Working from Bali',
                'excerpt' => 'Discover the digital nomad lifestyle and how to work remotely from paradise.',
                'content' => 'Full content about digital nomad life...',
                'category' => 'lifestyle',
                'images' => ['images/glacier1.jpeg', 'images/glacier2.jpeg', 'images/glacier3.jpeg'],
                'author_name' => 'Marcus Johnson',
                'author_initials' => 'M',
                'published_at' => now()->subDays(8),
                'tags' => ['nomad', 'work', 'bali', 'lifestyle']
            ],
            [
                'title' => 'Street Food Adventures in Bangkok',
                'excerpt' => 'Taste the authentic flavors of Bangkok\'s vibrant street food scene.',
                'content' => 'Full content about Bangkok street food...',
                'category' => 'food',
                'images' => ['images/str1.jpeg', 'images/str2.jpeg', 'images/str3.jpeg'],
                'author_name' => 'Emma Rodriguez',
                'author_initials' => 'E',
                'published_at' => now()->subDays(10),
                'tags' => ['street-food', 'thailand', 'culinary', 'food']
            ],
            [
                'title' => 'Northern Lights: Chasing Aurora in Iceland',
                'excerpt' => 'Experience the magical Northern Lights and the natural wonders of Iceland.',
                'content' => 'Full content about Northern Lights...',
                'category' => 'nature',
                'images' => ['images/beach1.jpeg', 'images/beach2.jpeg', 'images/beach3.jpeg'],
                'author_name' => 'David Thompson',
                'author_initials' => 'D',
                'published_at' => now()->subDays(12),
                'tags' => ['northern-lights', 'iceland', 'photography', 'nature']
            ]
        ];

        foreach ($posts as $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);

            $postData['slug'] = Str::slug($postData['title']);

            $post = Post::create($postData);

            $tagIds = Tag::whereIn('name', $tags)->pluck('id');
            $post->tags()->attach($tagIds);
        }
    }
}
