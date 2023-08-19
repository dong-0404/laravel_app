<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getAllOrders();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = $this->orderRepository->getOrderById($id);
        return response()->json($order);
    }

    public function store(Request $request)
{
    $data = $request->all();
    $data['user_id'] = auth()->user()->id; // Lấy id của người đăng nhập
    $order = $this->orderRepository->createOrder($data);
    return response()->json($order, 201);
}


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $order = $this->orderRepository->updateOrder($id, $data);
        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
