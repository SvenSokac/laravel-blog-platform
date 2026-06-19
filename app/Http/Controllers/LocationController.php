<?php

namespace App\Http\Controllers;

use App\Models\UserLocation;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class LocationController extends Controller
{
    // Track user location when they visit the page
    public function track()
    {
        $ip = request()->ip();

        // If testing on localhost, use a sample IP:
        if ($ip == "127.0.0.1") {
            $ip = "102.89.23.11"; // Replace with any external IP for testing
        }

        $record = Location::get($ip);

        if ($record) {
            UserLocation::create([
                'ip' => $ip,
                'country' => $record->countryName,
                'city' => $record->cityName,
                'latitude' => $record->latitude,
                'longitude' => $record->longitude,
            ]);
        }

        return redirect()->route('location-map');
    }

    // Display map with all visitors
    public function showMap()
    {
        $visitors = UserLocation::whereNotNull('latitude')
                           ->whereNotNull('longitude')
                           ->get();

        return view('location', compact('visitors'));
    }
}
