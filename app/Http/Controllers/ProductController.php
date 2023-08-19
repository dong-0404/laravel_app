<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);


        $product = $this->productRepository->create($data);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        // ... Upload image and other logic ...

        $product = $this->productRepository->update($id, $data);

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
