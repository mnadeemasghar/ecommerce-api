<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponse;
    
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepository = $categoryRepositoryInterface;
    }
    public function home(){
        $categories = $this->categoryRepository->getCategories();
        // all products

        return $this->success_respoonse([
            $categories
        ],"Home");

    }
}
