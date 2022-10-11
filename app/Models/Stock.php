<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'store_id',
        'supplier_id'
    ];

    public function provider ()
    {
        return $this->belongsTo(Provider::class, 'supplier_id');
    }

    public function store() {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

