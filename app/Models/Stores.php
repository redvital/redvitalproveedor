<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $fillable = [
        'name',
        'location',
        'description',
        'code'
    ];

    public function stock() {
        return $this->hasMany(Stock::class, 'store_id');
    }
    public function productProvider(){
        return $this->belongsToMany(ProductProvider::class, 'stocks', 'store_id', 'product_providers_id');
        }
}
