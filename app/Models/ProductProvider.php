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

    public function stock(){
        return $this->hasMany(Stock::class, 'product_providers_id');
    }
    public function store(){
        return $this->belongsToMany(Store::class, 'stocks', 'product_providers_id', 'store_id');

    }
}
