<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalSupplierInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'fiscal_address',
        'state',
        'postal_code',
        'web_page',
        'commercial_name',
        'payment_condition',
        'retention',
        'consignment',
        'representative_id',
        'rif',
        'commercial_register',
        'identification_document'

    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'supplier_id');
    }
}
