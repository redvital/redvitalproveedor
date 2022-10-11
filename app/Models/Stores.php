<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'description',
        'code'
    ];

    public function stock() {
        return $this->hasMany(Stock::class, 'store_id');
    }
}
