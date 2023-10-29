<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends EloquentRepository
{
    public function getModel()
    {
        return Product::class;
    }
    public function delete($id)
    {
        $product = $this->find($id);
        $product->delete();
    }
    public function getProductsByCategoryId($categoryId)
    {
        $query = $this->_model->where('category_id', $categoryId);
        return $query->get();
    }

}
