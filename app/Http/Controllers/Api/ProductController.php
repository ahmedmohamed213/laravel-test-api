<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        //   min
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        //   max
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();


        return response()->json($products, ['message' => 'product list']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, ['message' => 'product created successfly', 201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product, ['message' => 'product details']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response()->json(['message' => 'product updated successfly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'product deleted successfly']);
    }
}
