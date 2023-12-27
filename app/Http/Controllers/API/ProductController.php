<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $products = Product::all();
        return $this->success_respoonse($products, "All Products");
    }

    public function show(Product $product)
    {
        return $this->success_respoonse($product,"Single Product");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('product_images'), $imageName);
            $data['image'] = 'product_images/' . $imageName;
        }

        $product = Product::create($data);

        return $this->success_respoonse($product,'Product created successfully');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('product_images'), $imageName);
            $data['image'] = 'product_images/' . $imageName;
        }

        $product->update($data);

        return $this->success_respoonse($product,'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return $this->success_respoonse(new stdClass,'Product deleted successfully');
    }
}
