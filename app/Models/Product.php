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
        'bar_code',
        'image',
        'status',
        'price',
        'units',
        'team_id',
        'user_id',
        'agreement_id',
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
