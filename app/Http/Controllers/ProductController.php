<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //show product page listing all the products stored in db
    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();
        return view('products.index', [
            'products' => $products
        ]);

    }

    //create product details
    public function create() {
        return view('products.create');

    }

    //store product detail in db
    public function store(Request $request) {
        $rules = [
            'product'=> 'required|max:10',
            'category'=> 'required|max:7',
            'price'=> 'required|numeric',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //inserting the product into the db
        $product = new Product();
        $product->product = $request->product;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image !="") {
                    //storing images into the db
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext; //unique image name

                //save image uploads to the public/image directory
                $image->move(public_path('/images'), $imageName);

                //save image into database
                $product->image = $imageName;
                $product->save();

        }


        


        return redirect()->route('products.index')->with('success', 'Added Product Successfully!');






    }

    //edit the information 
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ])->with('success', 'Updated Product successfully!');

    }
    

    //deletes product from the db

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            Session::flash('success', 'Product deleted successfully!');
            return redirect()->route('products.index');
        } else {
            Session::flash('error', 'Product not found!');
            return redirect()->route('products.index');
        }
    }
}
