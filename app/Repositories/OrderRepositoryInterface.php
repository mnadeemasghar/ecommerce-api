<?php
namespace App\Repositories;

interface OrderRepositoryInterface{
    public function addToCart($data);
    public function removeFromCart($data);
    public function placeOrder();
    public function getOrders();
}