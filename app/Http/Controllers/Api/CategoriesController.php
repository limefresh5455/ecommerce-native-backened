<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Category;

class CategoriesController extends Controller
{
    function getCategory() {
        return Category::all();
      }

      function Category_add(Request $req) {
        $validator =  Validator::make($req->all(),[
            'product_id' => 'required',
            'category_name' => 'required',
            'checkout_id'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false, 
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
        try{
            $Category = new Category;
            $Category->product_id = $req->input('product_id');
            $Category->category_name = $req->input('category_name');
            $Category->checkout_id = $req->input('checkout_id');
            $Category->save();
            return response()->json(['success' => true, 'message' => 'Category Add Successfully'], 200);
        } catch(Exception $e){
            return response()->json([
                "error" => "could_not_register",
                "message" => "Unable to register user"
            ], 400);
        }
    }  
}
