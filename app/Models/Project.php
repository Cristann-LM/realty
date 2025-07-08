<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'name',
        'description',
        'address',
        'city',
        'province',
        'google_map_link',
    ];

    public function developer() :BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function amenities():HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function properties():HasMany
    {
        return $this->hasMany(Property::class);
    }
    public function scopeMostRecent(Builder $query): Builder{
        return $query->latest('created_at');
    }
}
