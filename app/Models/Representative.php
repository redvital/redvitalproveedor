<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
        'commercial_register',
        'rif',
        'representatives_document',
        'supplier_id'
    ];


    
}
