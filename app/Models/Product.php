<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $filable  =[
        'name', 'description', 'price', 'stock', 'brand_id', 'provider_id'
    ];
    public function brand(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function provider(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    public function details(): BelongsTo
    {
        return $this->belongsTo(Detail::class);
    }


   
}
