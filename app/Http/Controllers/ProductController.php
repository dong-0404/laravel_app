<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    private $productRepository;
    private $serviceRepository;

    public function __construct(ProductRepository $productRepository, ServiceRepository $serviceRepository)
    {
        $this->productRepository = $productRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll()->toArray();
//        dd($products);
        $items = $this->serviceRepository->paginate($products);
//        $items->path('');
//        dd($items);
        return response()->json($items);
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
//            dd($fileNameOnly);
            $extenshion = $request->file('image')->getClientOriginalExtension();
//            dd($extenshion);

            $comPic = str_replace('', '_', $fileNameOnly). '-'.rand().'_'.time().'.'.$extenshion;
//            dd($comPic);

            $path = $request->file('image')->store('public/uploads');
            $image = $request->file('image')->hashName();
//            dd($path);

//            dd($path);
//            $data['image'] = $comPic; // Gán tên ảnh cho trường image trong dữ liệu
        }
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $price = $request->input('price');
        $description = $request->input('description');
        $data = [
            'name' => $name,
            'category_id' => $category_id,
            'price' => $price,
            'description' => $description,
            'image' => $image,
        ];

//        $data = $request->validate([
//            'name' => 'required',
//            'category_id' => 'required',
//            'image' => ['nullable','image'],
//            'description' => 'nullable',
//            'price' => 'required|numeric',
//        ]);

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


        $product = $this->productRepository->update($id, $data);

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
