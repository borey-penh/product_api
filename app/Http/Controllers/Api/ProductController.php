<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET ALL
    public function index()
    {
        return response()->json(Product::all());
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($request->all());

        return response()->json($product);
    }

    // UPDATE (EDIT)
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Updated successfully',
            'product' => $product
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Deleted']);
    }
}