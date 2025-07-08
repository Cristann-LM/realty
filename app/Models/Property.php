<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'type',
        'price',
        'floor_area',
        'lot_area',
        'bedrooms',
        'bathrooms',
        'parking_spaces',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function propertyImages()
        {
            return $this->hasMany(PropertyImage::class)->orderByDesc('is_primary');
        }

    public function scopeMostRecent(Builder $query): Builder{
        return $query->latest('created_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['propertyType'] ?? false, function (Builder $query, string $propertyType) {
                return $query->where('type', $propertyType);
            })
            ->when($filters['location'] ?? false, function (Builder $query, string $location) {
                return $query->whereHas('project', function ($q) use ($location) {
                    $q->where('city', 'like', "%{$location}%");
                });
            })
            ->when($filters['price_min'] ?? false, function (Builder $query, int $priceMin) {
                return $query->where('price', '>=', $priceMin);
            })
            ->when($filters['price_max'] ?? false, function (Builder $query, int $priceMax) {
                return $query->where('price', '<=', $priceMax);
            });
    }
}
