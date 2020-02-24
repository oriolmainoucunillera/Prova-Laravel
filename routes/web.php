<?php

use Illuminate\Http\Request;
use App\Product;

Route::middleware('auth')->group(function() {
    // TOTES LES RUTES ES POSEN DINS LA FUNCIÓ I S'EXECUTARAN QUAN HI HAGI UN LOGIN

    Route::get('products', function () {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    })->name('products.index');
    
    Route::get('products/create', function() {
        return view('products.create');
    })->name('products.create');
    
    Route::post('products', function (Request $request) {
        // return $request->all(); --> amb aixo et mostra tot el que conté l'array
        $newProduct = new Product();
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->save();
        return redirect()->route('products.index')->with('info', 'Pujat correctament.');
    })->name('products.store');
    
    Route::delete('products/{id}', function($id) {
        //return $id;
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('info', 'Eliminat correctament.');
    })->name('products.destroy');
    
    Route::get('products/{id}/edit', function($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    })->name('products.edit');
    
    Route::put('/products/{id}', function(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('products.index')->with('info', 'Actualitzat correctament.');
    })->name('products.update');

});

Auth::routes();
