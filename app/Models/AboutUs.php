<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    /** @use HasFactory<\Database\Factories\AboutUsFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'mission',
        'vision',
        'image',
    ];
}
