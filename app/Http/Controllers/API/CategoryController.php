<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return $this->success_respoonse($categories,"All Categories");
    }

    public function show(Category $category)
    {
        $category->load('children');
        return $this->success_respoonse($category,"Single Category");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('category_images'), $imageName);
            $data['image'] = 'category_images/' . $imageName;
        }

        $category = Category::create($data);

        return $this->success_respoonse($category,"Category created successfully");
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('category_images'), $imageName);
            $data['image'] = 'category_images/' . $imageName;
        }

        $category->update($data);

        return $this->success_respoonse($category,'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        return $this->success_respoonse(new stdClass(), 'Category deleted successfully');
    }
}
