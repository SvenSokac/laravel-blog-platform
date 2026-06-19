<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Reaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class BlogOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::whereNotNull('published_date')->count();
        $totalComments = Comment::whereNull('parent_id')->count();
        $totalReactions = Reaction::sum('count');
        $averageReactionsPerBlog = $totalBlogs > 0 ? round($totalReactions / $totalBlogs, 1) : 0;

        return [
            Card::make('Total Blog Posts', $totalBlogs)
                ->icon('heroicon-o-document-text')
                ->color('info'),
            Card::make('Published Blogs', $publishedBlogs)
                ->description('Live on website')
                ->color('success')
                ->icon('heroicon-o-check-circle'),
            Card::make('Total Comments', $totalComments)
                ->description('Top-level comments')
                ->color('warning')
                ->icon('heroicon-o-chat-alt-2'),
            Card::make('Total Reactions', $totalReactions)
                ->description('Avg: ' . $averageReactionsPerBlog . ' per blog')
                ->color('primary')
                ->icon('heroicon-o-heart'),
        ];
    }
}
