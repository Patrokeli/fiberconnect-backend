<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    

    protected $fillable = [
        'name', 'speeds', 'prices', 'installation', 'coverage'
    ];

    protected $casts = [
        'speeds' => 'array',
        'prices' => 'array',
        'coverage' => 'array',
    ];


}
