<?php
namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderRepository implements OrderRepositoryInterface{

    public function addToCart($data){
        $cart_data = Cart::where('user_id', Auth::user()->id)->first();
        if($cart_data != null){
            $cart = $cart_data;
        }
        else{
            Cart::create(['user_id' => Auth::user()->id]);
            $cart = Cart::where('user_id', Auth::user()->id)->first();
        }

        $cart_details_data = CartDetail::where("cart_id" , $cart->id)->where("product_id" , $data->product_id)->first();
        
        if($cart_details_data != null){
            $cart_details_data->update([
                "qty" => $data->qty
            ]);
        }
        else{
            CartDetail::create([
                "cart_id" => $cart->id,
                "product_id" => $data->product_id,
                "qty" => $data->qty,
            ]);
        }

        return CartDetail::where("cart_id" , $cart->id)->get();
    }
}