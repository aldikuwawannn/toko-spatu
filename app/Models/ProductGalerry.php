<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class ProductGalerry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'address',
        'payment',
        'total_price',
        'shipping_price',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'id');
    }
}
