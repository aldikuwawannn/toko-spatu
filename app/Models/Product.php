<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'categories_id',
        'tags',

    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductGalerry::class, 'products_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }
}
