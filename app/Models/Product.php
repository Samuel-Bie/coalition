<?php

namespace App\Models;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Product
{
    use HasFactory;


    public function save()
    {
        $product = static::find($this->id);
        if ($product)
            return $this->update();
        $this->id = Str::orderedUuid();
        $this->created_at = now()->toString();
        $this->updated_at = now()->toString();

        $products = static::all();
        $products = $products->push($this);
        return Storage::put('database/products.json', $products->toJson());
    }

    public function update()
    {

        $product = static::find($this->id);
        if (!$product)
            throw (new ModelNotFoundException)->setModel(
                get_class($this),
                $product
            );

        $this->delete();
        $this->updated_at = now()->toString();
        $products = static::all();
        $products = $products->push($this);
        return Storage::put('database/products.json', $products->toJson());
    }


    public static function all()
    {
        $file = Storage::get('database/products.json');
        return collect(json_decode($file));
    }


    public static function find($product)
    {
        $products = static::all();
        $product = $products->first(function ($value, $key) use ($product) {
            return $product == $value->id;
        });
    }

    public function delete()
    {
        $id = $this->id;
        $products = static::all();
        $products =  $products->filter(function ($value, $key) use ($id) {
            return $id != $value->id;
        });
        return Storage::put('database/products.json', $products->toJson());
    }
}
