<?php
namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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

    public function removeFromCart($data){
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
            $cart_details_data->delete();
        }
        else{
            return false;
        }

        return CartDetail::where("cart_id" , $cart->id)->get();
    }

    public function placeOrder(){
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if($cart != null){
            $cart_details = CartDetail::where("cart_id" , $cart->id)->get();

            Order::create([
                "user_id" => Auth::user()->id,
                "cart_id" => $cart->id,
                "sub_total" => 0,
                "sales_tax" => 0,
                "total" => 0
            ]);
            $order = Order::where("cart_id" , $cart->id)->first();

            foreach($cart_details as $cart_detail){
                $product = Product::where('id',$cart_detail->product_id)->first();
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart_detail->product_id,
                    'qty' => $cart_detail->qty,
                    'price' => $product->price,
                    'sub_total' => $product->price * $cart_detail->qty,
                ]);
            }

            $order_details = OrderDetail::where('order_id' , $order->id)->get();
            $sub_total = $order_details->sum('sub_total');
            $order->update([
                "sub_total" => $sub_total,
                "sales_tax" => 0.15,
                "total" => $sub_total + ( $sub_total * 0.15 )
            ]);

            $cart->delete();

            return Order::where("cart_id" , $cart->id)->with('order_detail')->first();


        }
        else{
            return false;
        }
    }

    public function getOrders(){
        return Order::where("user_id",Auth::user()->id)->with('order_detail')->get();
    }
}