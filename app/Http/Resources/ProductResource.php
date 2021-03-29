<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Product Id' => $this->id,
            'Product title' => $this->name,
            'Product description' => $this->description,
            'Price' => $this->price,
            'Sale price' => $this->sale_price,
            'Quantity' => $this->product_quantity,
            'User' => new userProductResource($this->user)
        ];
    }
}
