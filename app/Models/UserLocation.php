<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $table = 'userlocations';

    protected $fillable = [
        'ip', 'country', 'city', 'latitude', 'longitude'
    ];
}
