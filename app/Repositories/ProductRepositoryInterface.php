<?php
namespace App\Repositories;

interface ProductRepositoryInterface{
    public function getProducts();
    public function getProductById($id);
    public function storeProduct($request);
    public function updateProduct($request,$id);
    public function deleteProductById($id);
}