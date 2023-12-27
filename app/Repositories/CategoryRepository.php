<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getCategories(){
        return Category::with('children')->whereNull('parent_id')->get();
    }
    public function getCategoryById($id){
        return Category::with('children')->where('id',$id)->whereNull('parent_id')->first();
    }
    public function deleteCategoryById($id){
        $category = Category::find($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return $category->delete();
    }
    public function storeCategory($request){
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('category_images'), $imageName);
            $data['image'] = 'category_images/' . $imageName;
        }

        return $category = Category::create($data);
    }
    public function updateCategory($request, $id){
        $category = Category::find($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('category_images'), $imageName);
            $data['image'] = 'category_images/' . $imageName;
        }

        return $category->update($data);
    }
}