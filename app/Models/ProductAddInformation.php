<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku_redvital',
        'description',
        'code',
        'status',
        'sale_price',
        'iv',
        'catalogue',
        'brand',
        'sub_brand',
        'u_m',
        'base',
        'desc',
        'line',
       'sub_category'
    ];
}
