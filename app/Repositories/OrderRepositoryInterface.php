<?php
namespace App\Repositories;

interface OrderRepositoryInterface{
    public function addToCart($data);
    public function removeFromCart($data);
    public function placeOrder($request);
    public function getOrders();
}