<?php

namespace App\Http\Resources\DDList;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodDDListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'value' => $this->id,
            'label' => $this->payment_method
        ];
    }
}
