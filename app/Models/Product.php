<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'price',
        'qty',
        'image',
    ];

    protected $table = 'product'; // Specify the correct table name
}
