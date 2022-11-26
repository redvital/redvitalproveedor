<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_providers_id',
        'store_id',
    ];

    public function provider ()
    {
        return $this->belongsTo(Provider::class, 'supplier_id');
    }

  

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }



    // relacion de modelos para centrar el stock por tiendas y proveedores
    public function product_providers() {
        return $this->belongsto(ProductProvider::class);
    }

    public function store() {
        return $this->belongsTo(Stores::class, 'store_id');
    }

}

