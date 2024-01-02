<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product3dImage;
use App\Models\ProductImage;
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

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('description')) {
            $query->Where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        return $this->success_respoonse($products, "Searched Products");
    }

    public function show(Product $product)
    {
        $productWithImages = $product->load('product_images')->load('product_3d_images');
        return $this->success_respoonse($productWithImages,"Single Product");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->all());

        return $this->success_respoonse($product,'Product created successfully');
    }

    public function addImage(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|file',
            'type' => 'required|in:2d,3d'
        ]);

        $data = $request->except('image');

        
        if($request->type == '2d'){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('product_images'), $imageName);
                $data['image_path'] = 'product_images/' . $imageName;
            }
            $product_image = ProductImage::create($data);
        }
        else if($request->type == '3d'){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.glb';
                $image->move(public_path('product_images'), $imageName);
                $data['image_path'] = 'product_images/' . $imageName;
            }
            $product_image = Product3dImage::create($data);
        }


        return $this->success_respoonse($product_image,'Image added successfully');
    }

    public function removeImage(ProductImage $product_image)
    {
        $product_image->delete();
        return $this->success_respoonse(new stdClass,'Image removed successfully');
    }

    public function remove3dImage(Product3dImage $product_image)
    {
        $product_image->delete();
        return $this->success_respoonse(new stdClass,'Image removed successfully');
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
        $product->delete();

        return $this->success_respoonse(new stdClass,'Product deleted successfully');
    }
}
