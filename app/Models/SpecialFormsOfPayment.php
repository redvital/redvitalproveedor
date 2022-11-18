<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialFormsOfPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_of_payment'
    ];
}
