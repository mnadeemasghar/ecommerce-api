<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class CategoryController extends Controller
{
    use ApiResponse;

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        return $this->success_respoonse($categories,"All Categories");
    }

    public function show(Category $category)
    {
        $category = $this->categoryRepository->getCategoryById($category->id);
        return $this->success_respoonse($category,"Single Category");
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $category = $this->categoryRepository->storeCategory($request);

        return $this->success_respoonse($category,"Category created successfully");
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->categoryRepository->updateCategory($request, $category->id);

        return $this->success_respoonse($category,'Category updated successfully');
    }

    public function destroy(Category $category)
    {

        $this->categoryRepository->deleteCategoryById($category->id);
        return $this->success_respoonse(new stdClass(), 'Category deleted successfully');
    }
}
