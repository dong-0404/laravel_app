<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends EloquentRepository
{

    public function getModel()
    {
        return Order::class;
    }


    public function getAllOrders()
    {
        return $this->_model->all();
    }
    public function getAllOrdersWithDetails()
    {
        $orders = DB::table('orders')
            ->select('orders.id', 'users.name as user_name', 'customers.name as customer_name','orders.total_amount','order_statuses.name as status_name')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('order_statuses', 'orders.status_id', '=', 'order_statuses.id')
            ->get();
        return $orders;
    }
    public function getOrdersByUserId($userId)
    {
        return $this->_model->where('user_id', $userId)->get();
    }


    public function getOrderById($id)
    {
        return $this->_model->find($id);
    }

    public function createOrder($data)
    {
        return $this->_model->create($data);
    }

    public function updateOrder($id, $data)
    {
        $order = $this->_model->find($id);
        if ($order) {
            $order->update($data);
            return $order;
        }
        return null;
    }

    public function deleteOrder($id)
    {
        $order = $this->_model->find($id);
        if ($order) {
            $order->delete();
            return true;
        }
        return false;
    }

    public function filterOrderItems($orderId, $userId, $customerId) {

        $query = $this->_model->query();

        $query->rightJoin('users', 'orders.user_id', '=', 'users.id');

        $query->rightJoin('customers', 'orders.customer_id', '=', 'customers.id');

        $query->rightJoin('order_statuses', 'orders.status_id', '=', 'order_statuses.id');

        if ($userId) {
            $query->where('users.id', $userId);
        }

        if ($customerId) {
            $query->where('customers.id', $customerId);
        }

        if ($orderId) {
            $query->where('orders.id', $orderId);
        }

        $query->select('orders.id',
            'users.name as user_name',
            'customers.name as customer_name',
            'orders.total_amount',
            'order_statuses.name as status_name');

        return $query->get();

    }



}
