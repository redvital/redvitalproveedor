<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RepresentativeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'commercial_register' => $this->commercial_register,
            'rif' => $this->rif,
            'representatives_document' => $this->representatives_document,
            'supplier_id' => $this->supplier_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
