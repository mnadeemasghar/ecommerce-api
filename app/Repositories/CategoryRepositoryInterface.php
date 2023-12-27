<?php
namespace App\Repositories;

interface CategoryRepositoryInterface{
    public function getCategories();
    public function getCategoryById($id);
    public function storeCategory($request);
    public function updateCategory($request,$id);
    public function deleteCategoryById($id);
}