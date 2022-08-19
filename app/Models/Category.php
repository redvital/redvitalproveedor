<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku_provee',
        'nombre',
        'barras',
        'status',
        'cantidad_empaque',
        'user_id',
        'team_id',
        'imagen',
        'condicion',
        'moneda',
        'cantidad',
        'cbulto',
        'cunidad',
        'psugerido',
        'categoria',
        'id'
    ];
}
