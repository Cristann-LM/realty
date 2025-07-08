<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    /** @use HasFactory<\Database\Factories\DeveloperFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function projects():HasMany
    {
        return $this->hasMany(Project::class);
    }

      public function scopeMostRecent(Builder $query): Builder{
        return $query->latest('created_at');
    }
}
