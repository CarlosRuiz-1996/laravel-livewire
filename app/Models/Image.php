<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'path', // Debe ser una cadena de caracteres para almacenar el nombre del archivo de imagen
        'product_id',
        // Otros campos si los tienes
    ];
}
