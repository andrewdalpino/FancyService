<?php

use App\Product;
namespace App\Http\Controllers;

class ProductController extends Controller
{
    /**
     * Return the product information given a UPC.
     *
     * @param  mixed  $upc
     * @return Response
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
