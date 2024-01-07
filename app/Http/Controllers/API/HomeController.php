<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponse;
    
    private $categoryRepository;
    private $productRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface
        )
    {
        $this->productRepository = $productRepositoryInterface;
        $this->categoryRepository = $categoryRepositoryInterface;
    }
    public function home(){
        $categories = $this->categoryRepository->getCategories();
        $products = $this->productRepository->getProducts();

        return $this->success_respoonse([
            "categories" => $categories,
            "products" => $products,
        ],"Home");

    }
}
