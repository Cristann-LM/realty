<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurJourney extends Model
{
    /** @use HasFactory<\Database\Factories\OurJourneyFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'year',
        'description',
    ];
}
