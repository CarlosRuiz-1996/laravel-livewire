<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $filable  =[
        'product_id', 'order_id', 'cantidad'
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }



    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
