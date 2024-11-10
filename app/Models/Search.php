<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'customer_id',
        'key_search',
    ];

    protected $casts = [
        'key_search' => 'array',
    ];
}
