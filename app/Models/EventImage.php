<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'image_path',
        'original_name',
        'alt_text',
        'caption',
        'sort_order',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the event that owns the image
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the full URL path for the image
     */
    public function getImageUrlAttribute()
    {
        return asset($this->image_path);
    }

    /**
     * Scope to get images ordered by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Scope to get only featured images
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
