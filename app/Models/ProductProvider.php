<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'provider_id',
        'commercialized',
        'approved'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class,  'provider_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,  'product_id');
    }
}
