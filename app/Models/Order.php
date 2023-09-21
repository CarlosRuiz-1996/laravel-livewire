<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $filable  =[
        'deadline', 'direccion', 'observaciones', 'user_id', 'status'
    ];
    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }
}
