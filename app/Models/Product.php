<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'content',
        'image',
        'price',
        'sale_price',
        'campaign_id',
        'status',
        'is_stock',
    ];

    public function productDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ImageDetail::class, 'product_id', 'id');
    }
}
