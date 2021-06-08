<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResourceCollection extends ResourceCollection
{
    public $collects = ProductResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'total_stock' => $this->collection->sum(function($value){
                return $value->price * $value->stock;
            }),
        ];
    }
}
