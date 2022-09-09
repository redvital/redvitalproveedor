<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBrand extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'id_brand',
        'name',
        'description'
    ];
}
