<?php
namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $orderRepository;
    private $serviceRepository;

    public function __construct(OrderRepository $orderRepository, ServiceRepository $serviceRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->serviceRepository= $serviceRepository;
    }

    public function index()
    {
        $item = $this->orderRepository->getAllOrdersWithDetails()->toArray();
//        dd($item);
        $orders = $this->serviceRepository->paginate($item, 5);
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
        // $data['user_id'] = auth()->user()->id;
        $order = $this->orderRepository->updateOrder($id, $data);
        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);
        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    public function search(Request $request)
    {
        $orderId = $request->input('orderId');
        $userId = $request->input('userId');
        $customerId = $request->input('customerId');
        if($orderId || $userId || $customerId) {
        $results = $this->orderRepository->filterOrderItems($orderId, $userId, $customerId);
            return response()->json($results);
            }
        return 0;
    }

}
