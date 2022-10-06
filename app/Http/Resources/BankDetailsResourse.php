<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankDetailsResourse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bank' => $this->bank_name,
            'currency' => $this->currency,
            'method_of_payment' => $this->method_of_payment,
            'account_number' => $this->account_number,
            'account_type' => $this->account_type,
            'account_holder' => $this->account_holder,
            'rif' => $this->rif,
            'observations' => $this->observations,
            'supplier_id' => $this->supplier_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
