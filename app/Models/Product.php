<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Product
{
    use HasFactory;


    public function save()
    {
        if (isset($this->id)) {
            $product = static::find($this->id);
            if ($product)
                return $this->update();
        }
        $this->id = (Str::orderedUuid())->toString();
        $this->created_at = now()->toString();
        $this->updated_at = now()->toString();

        $products = static::all();
        $products = $products->push($this);
        return Storage::put('database/products.json', $products->toJson());
    }

    public function update()
    {

        $product = static::findOrFail($this->id);

        $this->delete();
        $this->updated_at = now()->toString();
        $products = static::all();
        $products = $products->push($this);
        return Storage::put('database/products.json', $products->toJson());
    }


    public static function all()
    {
        $products = [];
        try {
            $file = Storage::get('database/products.json');
            $products = collect(json_decode($file));
        } catch (FileNotFoundException $th) {
            return Storage::put('database/products.json', collect([])->toJson());
        }
        return $products;
    }


    public static function find($product)
    {
        $products = static::all();
        $product = $products->first(function ($value, $key) use ($product) {
            return $product == $value->id;
        });
        return $product;
    }

    public static function findOrFail($product)
    {
        $product = static::find($product);
        if (!$product)
            throw (new ModelNotFoundException)->setModel(
                static::class,
                $product
            );
        return $product;
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
