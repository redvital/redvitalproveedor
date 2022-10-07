<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'company',
        'rif',
        'provider_type'
    ];

    public function bankDetails()
    {
        return $this->hasMany(SupplierBankDetails::class, 'supplier_id');
    }

    public function supplierInformation()
    {
        return $this->hasMany(AdditionalSupplierInformation::class, 'supplier_id');
    }
}

//hola 