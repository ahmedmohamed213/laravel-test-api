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

        // min price
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // max price
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        return response()->json([
            'message' => 'Product list',
            'data'    => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'message' => 'Product details',
            'data'    => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully',
            'data'    => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
