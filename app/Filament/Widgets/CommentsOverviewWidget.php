<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CommentsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $totalComments = Comment::count();
        $topLevelComments = Comment::whereNull('parent_id')->count();
        $replies = Comment::whereNotNull('parent_id')->count();
        $totalLikes = Comment::sum('likes');

        return [
            Card::make('Total Comments', $totalComments)
                ->icon('heroicon-o-chat-alt-2')
                ->color('info'),
            Card::make('Top-Level Comments', $topLevelComments)
                ->description('Direct blog comments')
                ->color('success')
                ->icon('heroicon-o-chat'),
            Card::make('Replies', $replies)
                ->description('Comment replies')
                ->color('warning')
                ->icon('heroicon-o-reply'),
            Card::make('Total Likes', $totalLikes)
                ->description('Comment engagement')
                ->color('primary')
                ->icon('heroicon-o-heart'),
        ];
    }
}
