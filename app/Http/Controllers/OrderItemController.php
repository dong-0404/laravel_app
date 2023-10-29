<?php

namespace App\Http\Controllers;


use App\Repositories\CategoriesRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    private $orderItemRepository;
    private $categoryRepository;
    private $productRepository;

    public function __construct(
        OrderItemRepository $orderItemRepository,
        CategoriesRepository $categoryRepository,
        ProductRepository $productRepository,
    )
    {
        $this->orderItemRepository = $orderItemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index($orderId)
    {
        // Lấy danh sách chi tiết đơn hàng
        $orderItems = $this->orderItemRepository->getOrderItemByOrderId($orderId);
        return response()->json($orderItems);
    }

    public function show($id)
    {
        // Lấy chi tiết đơn hàng bằng ID
        $orderItem = $this->orderItemRepository->getOrderItemByOrderId($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }
        return response()->json($orderItem);
    }

    public function store(Request $request)
    {
        $OrderId = $request->input('order_id');
        $ProductId = $request->input('product_id');
        $Quantity = $request->input('quantity');
        // $password = $request->input('password');

        $data = [
            'order_id' => $OrderId,
            'product_id' => $ProductId,
             'quantity' => $Quantity
        ];
        $newItem = $this->orderItemRepository->createOrderItem($data);
        return response()->json($newItem);
    }


    public function update(Request $request, $id)
    {
        // Cập nhật chi tiết đơn hàng bằng ID
        $data = $request->all();
        $orderItem = $this->orderItemRepository->updateOrderItem($id, $data);
        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }
        return response()->json($orderItem, 200);
    }

    public function destroy($id)
    {
        $result = $this->orderItemRepository->deleteOrderItem($id);
        if ($result) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        }
        return response()->json(['message' => 'Order item not found'], 404);
    }
}
