<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // public function optionValues()
    // {
    //     return $this->belongsToMany(OptionValue::class, 'product_option_values')
    //                 ->withPivot('quantity');
    // }

    // public function optionTypes()
    // {
    //     return $this->hasManyThrough(OptionType::class, OptionValue::class, 'id', 'id', 'id', 'option_type_id')
    //                 ->distinct();
    // }
}
