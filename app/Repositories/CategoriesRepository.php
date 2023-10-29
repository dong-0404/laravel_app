<?php
namespace App\Repositories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;

class CategoriesRepository extends EloquentRepository
{
    public function getModel()
    {
        return Categories::class;
    }

    public function getAll()
    {
        return $this->_model->all();
    }
    public function getCategoryById($categoryId) {
        // Sử dụng phương thức find để tìm danh mục theo ID
        $category = $this->_model->find($categoryId);
            // Nếu tồn tại, trả về tên của danh mục
            return $category->name;
        }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function create($data)
    {
        return $this->_model->create($data);
    }

    public function update($id, $data)
    {
        $category = $this->find($id);

        if ($category) {
            $category->update($data);
            return $category;
        }

        return null;
    }

    public function delete($id)
    {
        $category = $this->find($id);

        if ($category) {
            $category->delete();
            return true;
        }

        return false;
    }
}
