<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products', function(){

    return Product::all();

});


Route::post('/products', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric'
    ]);

    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price
    ]);

    return response()->json($product);
});