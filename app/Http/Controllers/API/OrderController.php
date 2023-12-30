<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\API\RemoveFromCartRequest;
use App\Repositories\OrderRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponse;

    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepository = $orderRepositoryInterface;
    }

    public function addToCart(AddToCartRequest $request){
        $result = $this->orderRepository->addToCart($request);

        if($result){
            return $this->success_respoonse($result,"Added to cart!");
        }
        else{
            return $this->error_respoonse($result,"Somthing went wrong!");
        }
    }

    public function removeFromCart(RemoveFromCartRequest $request){
        $result = $this->orderRepository->removeFromCart($request);

        if($result){
            return $this->success_respoonse($result,"Removed from cart!");
        }
        else{
            return $this->error_respoonse($result,"Somthing went wrong!");
        }
    }

    public function placeOrder(){
        $result = $this->orderRepository->placeOrder();

        if($result){
            return $this->success_respoonse($result,"Order placed!");
        }
        else{
            return $this->error_respoonse($result,"Somthing went wrong!");
        }
    }

    public function getOrders(){
        $result = $this->orderRepository->getOrders();

        if($result){
            return $this->success_respoonse($result,"Orders!");
        }
        else{
            return $this->error_respoonse($result,"Somthing went wrong!");
        }
    }
}
