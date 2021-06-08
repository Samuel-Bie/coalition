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
            "name" => $this->name,
            "quantity" => $this->stock,
            "price" => $this->price,
            "total_value_number" => $this->price * $this->stock, // Total in stock
            "created_at" => $this->created_at, // stands for submitted at
            "updated_at" => $this->updated_at, // stands for submitted at
        ];
    }
}
