<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'sku_provider',
            'name',
            'description',
            'code',
            'condition',
            'bar_code',
            'image',
            'status',
            'currency',
            'method_of_payment',
            'cost_per_unit',
            'cost_per_package',
            'sugessted_price',
            'sale_price',
            'units',
            'iv',
            'catalogue',
            'brand',
            'sub_brand',
            'u_m',
            'base',
            'desc',
            'line',
            'description1',
            'category',
            'description2',
           'sub_category',
           'description3',
           'team_id',
           'user_id',
           'agreement_id'
    ];

    public function agreement_type()
    {
        return $this->hasOne(TypeAgreement::class, 'id', 'agreement_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'agreement_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }
}
