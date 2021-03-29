<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response([ 'products' => ProductResource::collection($products), 'message' => 'Products Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_product = $request->all();

        $validatedData = Validator::make($data_product, [
            'name' => 'required|string|max:25|unique:products',
            'description' => 'required|string',
            'price' => 'required|max:15',
            'product_quantity' => 'required',
            'sale_price' => 'required|max:15'
        ]);

        if($validatedData->fails()){
            return response(['error' => $validatedData->errors(), 'Validation Error']);
        }

        $product = Product::create($data_product);

        return response([ 'product' => new ProductResource($product), 'message' => 'Product Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if(is_null($product)) {
            return response()->json(["message" => "Product not found !"], 404);
        }
        return response([ 'product' => new ProductResource($product), 'message' => 'Product Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response([ 'product' => new ProductResource($product), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(['message' => 'Deleted']);
    }
}
