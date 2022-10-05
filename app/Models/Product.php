<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'sku_provider',
            'sku_redvital',
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
            'pvp_t01',
            'desc01',
            'pvp_t02',
            'desc02',
            'pvp_t03',
            'desc03',
            'pvp_t04',
            'desc04',
            'pvp_t05',
            'desc05',
            'pvp_t06',
            'desc06',
            'pvp_t07',
            'desc07',
            'pvp_t08',
            'desc08',
            'pvp_t09',
            'desc09',
            'pvp_t27',
            'desc27',
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

    public function product()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
