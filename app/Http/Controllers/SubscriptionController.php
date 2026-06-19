<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create($validated);

        Alert::success('Success', 'Thanks for subscribing to our newsletter!');
        return back();
    }
}
