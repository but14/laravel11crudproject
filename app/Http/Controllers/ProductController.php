<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //this method will show product page
    public function index(){
        return view('products.list');
    }


    //This method will show create product page
    public function create(){
        return view('products.create');
    }

    //This method will store a product in db
    public function store(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',

        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // here we will insert 
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    // This method will show edit product page
    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
