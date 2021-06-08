<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
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
            'links' => [
                'self' => [
                    'web' => URL::route('web.products.show', ['product' => $this->id]),
                    'api' => URL::route('api.products.show', ['product' => $this->id]),
                ]
            ]
        ];
    }
}
