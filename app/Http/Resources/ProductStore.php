<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStore extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'product_id' => $this->product,
            'provider' => $this->provider,
        ];
        return [
            'product' => $product
        ];
    }
}
