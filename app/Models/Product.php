<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
            'category',
            'sku_provider',
            'bar_code',
            'image',
            'method_of_payment',
            'condition',
            'currency',
            'units',
            'cost_per_unit',
            'cost_per_package',
            'sugessted_price'
    ];

    public function agreement_type()
    {
        return $this->hasOne(TypeAgreement::class, 'id', 'agreement_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'agreement_id');
    }

    public function Team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function productAddInformations(){
        return $this->hasOne(ProductAddInformation::class, 'id', 'product_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }
    public function providers(){
        return $this->belongsToMany(Provider::class, 'product_providers', 'product_id', 'provider_id', );
    }
    public function ProductProvider(){
        return $this->hasMany(ProductProvider::class);
    }
}
