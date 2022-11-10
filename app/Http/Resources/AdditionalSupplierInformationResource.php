<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalSupplierInformationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'supplier_id' => $this->supplier_id,
            'fiscal_address' => $this->fiscal_address,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'web_page' => $this->web_page,
            'commercial_name' => $this->commercial_name,
            'payment_condition' => $this->payment_condition,
            'retention' => $this->retention,
            'consignment' => $this->consignment,
            'representative_id' => $this->representative_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
