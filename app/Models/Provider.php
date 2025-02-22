<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table= "providers";
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'company',
        'rif',
        'provider_type',
        'user_id'
    ];

    public function bankDetails()
    {
        return $this->hasMany(SupplierBankDetails::class, 'supplier_id');
    }
    public function providerForProduct(){
        return $this->hasMany(ProductProvider::class);
    }
    public function represemtativeUser(){ 
        return $this->hasMany(Representative::class,'supplier_id');
    }
    public function supplierInformation()
    {
        return $this->hasMany(AdditionalSupplierInformation::class, 'supplier_id');
    }

    public function stock () {
        return $this->hasMany(Stock::class, 'supplier_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_providers','provider_id', 'product_id');
    }
    public function ProductProvider(){
        return $this->hasMany(ProductProvider::class);
    }
    public function User(){
        return $this->hasOne(User::class, 'user_id');
    }
}
