<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderById($id)
    {
        return Order::find($id);
    }

    public function createOrder($data)
    {
        return Order::create($data);
    }

    public function updateOrder($id, $data)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update($data);
            return $order;
        }
        return null;
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return true;
        }
        return false;
    }
}
