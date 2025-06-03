<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $casts = [
        'speeds' => 'array',
        'prices' => 'array',
        'coverage' => 'array',
    ];

}
