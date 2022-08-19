<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku_provee',
        'condicion',
        'moneda',
        'cantidad',
        'cbulto',
        'cunidad',
        'psugerido'
    ];
}
