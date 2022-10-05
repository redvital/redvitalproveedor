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
        return $this->hasOne(Provider::class, 'id', 'provider_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
