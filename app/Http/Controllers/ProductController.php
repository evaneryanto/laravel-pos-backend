<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
   public function index(Request $request){

      //$users = User::paginate(10);
      $products = DB::table('products')
                  ->when($request->input('products'),function($query,$name){
                      return $query->where('name','like','%'.$name.'%');
                  })
                      ->orderBy('id','desc')
                      ->paginate(10);
      return view('pages.products.index',compact('products'));
  }

  public function create(){
      return view('pages.products.create');
  }

  public function store(Request $request){

    $request->validate([
        'name' => 'required|min:3|unique:products',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'category' => 'required|in:food,drink,snack',
        'image' => 'required|image|mimes:png,jpg,jpeg'
    ]);

    $filename = time().'.'.$request->image->extension();
    $request->image->storeAs('public/products',$filename);


    $data = $request->all();

    $product = new \App\Models\Product;

    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = (int) $request->price;
    $product->stock = (int) $request->stock;
    $product->category = $request->category;
    $product->image = $filename;
    $product->save();

    return redirect()->route('product.index')->with('success','Product created succesfully');


  }

  public function edit($id){

      $product = Product::findOrFail($id);
      return view('pages.products.edit',compact('product'));
  }

  public function update(Request $request, $id){
      //dd($id);
      $data = $request->all();
      $product = Product::findOrFail($id);
      $product->update($data);
      return redirect()->route('product.index')->with('success','Product updated succesfully');
  }

   public function destroy(Product $product){
       $product->delete();
       return redirect()->route('product.index')->with('success','Product deleted succesfully');
   }
}
