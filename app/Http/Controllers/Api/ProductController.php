<?php

namespace App\Http\Controllers\Api;



use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProductResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->sortByDesc(function ($product, $key) {
            return (new Carbon($product->created_at))->timestamp;
        });

        // dd($products);
        return new ProductResourceCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        $product->stock = $request->input("stock");
        $product->save();
        return response()->json(new ProductResource($product), Response::HTTP_CREATED);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::find($product);
        if ($product)
            return new ProductResource($product);
        abort(Response::HTTP_NOT_FOUND, 'Product not found');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $product = Product::find($product);
        if (!$product)
            abort(Response::HTTP_NOT_FOUND, 'Product not found');
        $product = new Product();
        $product->id = $product;
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        $product->stock = $request->input("stock");
        $product->save();
        return response()->json(new ProductResource($product), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
