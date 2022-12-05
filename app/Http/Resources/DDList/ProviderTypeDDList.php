<?php

namespace App\Http\Resources\DDList;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderTypeDDList extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->id,
            'label' => $this->provider_type
        ];
    }
}

