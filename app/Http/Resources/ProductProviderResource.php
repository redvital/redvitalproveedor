<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductProviderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku_provider' => $this->sku_provider,
            'sku_redvital'=> $this->sku_redvital,
            'name' => $this->name,
            'description' => $this->description,
            'code'=> $this->code,
            'condition' => $this->condition,
            'bar_code' => $this->bar_code,
            'image' => $this->image,
            'status' => $this->status,
            'currency' => $this->currency,
            'method_of_payment' => $this->method_of_payment,
            'cost_per_unit' => $this->cost_per_unit,
            'cost_per_package' => $this->cost_per_package,
            'sale_price' => $this->sale_price,
            'sugessted_price' => $this->sugessted_price,
            'units' => $this->units,
            'iv' => $this->iv,
            'catalogue' => $this->catalogue,
            'brand' => $this->brand,
            'sub_brand' => $this->sub_brand,
            'u_m' => $this->u_m,
            'base' => $this->base,
            'desc'=> $this->desc,
            'line' => $this->line,
            'description1' => $this->description1,
            'description2' => $this->description2,
            'description3' => $this->description3,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'team_id' => $this->team_id,
            'user_id' => $this->user_id,
            'agreement_id' => $this->agreement_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];

    }
}
