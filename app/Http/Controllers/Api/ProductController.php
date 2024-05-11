<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'ist Data Product',
            'data' => $products
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3|unique:products',
        //     'price' => 'required|integer',
        //     'stock' => 'required|integer',
        //     'category' => 'required|in:food,drink,snack',
        //     'image' => 'required|image|mimes:png,jpg,jpeg'
        // ]);

        // $filename = time().'.'.$request->image->extension();
        // $request->image->storeAs('public/products',$filename);


        // $data = $request->all();
        // $product = new \App\Models\Product;

        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->price = (int) $request->price;
        // $product->stock = (int) $request->stock;
        // $product->category = $request->category;
        // $product->image = $filename;
        // $product->save();

        //return redirect()->route('product.index')->with('success','Product created succesfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
