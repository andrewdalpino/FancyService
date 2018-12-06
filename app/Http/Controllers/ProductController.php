<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Return the product information given a UPC.
     *
     * @param  mixed  $upc
     * @return \Illuminate\Http\JsonResponse
     */
    public function lookup($upc)
    {
        $product = Product::lookup($upc);

        return response()->json([
            'id' => $product->id,
            'upc' => $product->upc,
            'name' => $product->name,
            'description' => $product->description,
            'created_at' => $product->created_at,
        ]);
    }
}
