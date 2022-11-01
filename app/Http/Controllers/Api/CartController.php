<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Carts;


class CartController extends Controller
{
    //
    function addCart(Request $req) {
       
        
        try{
            $registration = new Carts;
            $registration->carts_name = $req->input('carts_name');
            $registration->user_id = $req->input('user_id');
            $registration->product_id = $req->input('product_id');
            $registration->category_id = $req->input('category_id');
            $registration->quantity = $req->input('quantity');
            $registration->price = $req->input('price');
            $registration->save();
            return response()->json(['success' => true, 'message' => 'Add Cart Successfully'], 200);
        } catch(Exception $e){
            return response()->json([
                "error" => "could_not_register",
                "message" => "Unable to register user"
            ], 400);
        }
    }


    function getCart(Request $req){
        return Carts::count();

    }

    function getAllCart(Request $req){
        return Carts::all();
    }


}

