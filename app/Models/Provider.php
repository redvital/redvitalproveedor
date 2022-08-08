<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'commercial_register',
        'name',
        'dni',
        'rif',
        'price_list',
        'category_id',
        'agreement_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function product()
    {
        return $this->hasOne(TypeAgreement::class, 'id', 'agreement_id');
    }
}
