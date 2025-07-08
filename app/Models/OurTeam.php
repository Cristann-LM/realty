<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    /** @use HasFactory<\Database\Factories\OurTeamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'job_title',
        'job_description',
        'image',
    ];
}
