<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
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
}
