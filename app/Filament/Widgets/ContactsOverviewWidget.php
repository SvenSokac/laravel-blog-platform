<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ContactsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $totalContacts = Contact::count();
        $newContacts = Contact::whereDate('created_at', today())->count(); // Fixed: count today's contacts
        $subscribedContacts = Contact::where('subscribe', true)->count();
        $contactsThisMonth = Contact::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return [
            Card::make('Total Contacts', $totalContacts)
                ->icon('heroicon-o-mail')
                ->color('info'),
            Card::make("Today's Contacts", $newContacts)
                ->description('New submissions today')
                ->color('danger')
                ->icon('heroicon-o-inbox-in'),
            Card::make('Newsletter Subscribers', $subscribedContacts)
                ->description('Subscribed to newsletter')
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Card::make('This Month', $contactsThisMonth)
                ->description('Contact submissions')
                ->color('warning')
                ->icon('heroicon-o-calendar'),
        ];
    }
}
