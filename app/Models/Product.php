<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fields that are safe to mass-assign.
     * Note: 'views' is intentionally excluded — use incrementViews() instead.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'image',
    ];

    /**
     * Increment the view counter safely, bypassing mass assignment entirely.
     * Uses a raw SQL UPDATE to avoid race conditions.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get the category that owns the product.
     */
    /**
     * Get the full URL for the product image.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'http')
            ? $this->image
            : \Illuminate\Support\Facades\Storage::url($this->image);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
