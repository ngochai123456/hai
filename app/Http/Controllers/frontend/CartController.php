<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public function addcart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()) {
            $prod_check = Product::where('id',$product_id)->first();
            if($prod_check) {
                if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->jsonp(['status' => "AKREAKT ADD"]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->user_id = 1;
                    $cartItem->product_id = $product_id;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    return response()->jsonp(['status' => $prod_check->name." ADD"]);
                }
               
            } 
        } else {
            return response()->jsonp(['status' => "Login to Continue"]);
        }
    }
}