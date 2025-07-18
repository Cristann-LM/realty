<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    /** @use HasFactory<\Database\Factories\ContactUsFactory> */
    use HasFactory;

    protected $fillable = [
        'address',
        'email',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'google_map',
        'youtube',
        'tiktok',
    ];
}
