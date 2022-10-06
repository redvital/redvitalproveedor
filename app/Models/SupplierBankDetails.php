<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBankDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank',
        'currency',
        'method_of_payment',
        'account_type',
        'account_number',
        'account_holder',
        'rif',
        'observations',
        'supplier_id'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'supplier_id');
    }
}
