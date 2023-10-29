<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoriesRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $category = $this->categoryRepository->create($data);
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = $this->categoryRepository->update($id, $data);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function destroy($id)
    {
        $result = $this->categoryRepository->delete($id);

        if ($result) {
            return response()->json(['message' => 'Category deleted']);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }
}
