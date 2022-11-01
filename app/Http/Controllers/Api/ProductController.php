<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\product;

class ProductController extends Controller
{

    function product_add(Request $req) {
        $validator =  Validator::make($req->all(),[
            'prod_name' => 'required',
            'prod_descrition' => 'required',
            'prod_image'=> 'required',
            'prod_price'=> 'required',
            'quantity'=> 'required',
            'category_id'=> 'required', 
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false, 
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        try{
            $product = new product;
            $product->prod_name = $req->input('prod_name');
            $product->prod_descrition = $req->input('prod_descrition');
            if($req->hasFile('prod_image')){
                $image = $req->file('prod_image');
                $image_name = $image->getClientOriginalName();
                $image_name = 'product image' . time() . '.' . $image_name;
                $image->move(public_path('/images'), $image_name);
                $image_path = "/images/" . $image_name;
                $product->prod_image=asset($image_path);
            }
            $product->prod_price = $req->input('prod_price');
            $product->quantity = $req->input('quantity');
            $product->category_id = $req->input('category_id');
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product Add Successfully'], 200);
        } catch(Exception $e){
            return response()->json([
                "error" => "could_not_register",
                "message" => "Unable to register user"
            ], 400);
        }
    }


    function getProduct() {
        return product::all();
      }

      public function product_category($id) {
        $userWithDoc = product::where('products.category_id', '=', $id)
             ->join('categories', 'categories.id', '=', 'products.category_id')
             ->get();
    
        return response()->json($userWithDoc);
    }   
}
