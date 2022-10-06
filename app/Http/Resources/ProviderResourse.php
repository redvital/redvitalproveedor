<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResourse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'company' => $this->company,
            'rif' => $this->rif,
            'provider_type' => $this->provider_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'bank_details' => $this->bankDetails()->get(),
            'supplier_information' => $this->supplierInformation()->get(),
        ];
    }
}
