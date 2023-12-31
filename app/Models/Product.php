<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable  =[
        'name', 'description', 'price', 'stock', 'brand_id', 'provider_id', 'category_id'
    ];
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

   
}
