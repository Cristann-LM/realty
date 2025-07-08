<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyImageFactory> */
    use HasFactory;

    protected $fillable = [
        'image_path',
        'is_primary',

    ];
    protected $appends = [
        'src',
    ];
    public function property() :BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getSrcAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
