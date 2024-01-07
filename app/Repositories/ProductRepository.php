<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface{
    public function getProducts(){
        return Product::with([
            'product_images',
            'product_3d_images',
            'product_colors',
            'product_metas',
            'product_measurements',
            'product_reviews',
        ])->get();
    }

    public function getProductById($id){
        return Product::with([
            'product_images',
            'product_3d_images',
            'product_colors',
            'product_metas',
            'product_measurements',
            'product_reviews',
        ])->where('id',$id)->first();
    }

    public function storeProduct($request){
        return Product::create($request->all());
    }

    public function updateProduct($request,$id){
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('product_images'), $imageName);
            $data['image'] = 'product_images/' . $imageName;
        }

        $product = Product::find($id);
        return $product->update($data);
    }

    public function deleteProductById($id){
        $product = Product::find($id);
        return $product->delete();
    }
}