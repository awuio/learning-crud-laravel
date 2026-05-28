<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        $clearCache = fn () => \Illuminate\Support\Facades\Cache::forget('categories_all');

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    /**
     * Retrieve all categories from the cache, or database if cache is empty.
     */
    public static function getCachedAll()
    {
        return \Illuminate\Support\Facades\Cache::rememberForever('categories_all', function () {
            return static::all();
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
