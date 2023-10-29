<?php
namespace App\Repositories;

use App\Models\OrderItem;
class OrderItemRepository extends EloquentRepository {
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return OrderItem::class;
    }
    public function createOrderItem($data)
    {
        // Tạo một chi tiết đơn hàng mới
        return $this->_model->create($data);
    }

    public function getOrderItemByOrderId($orderId)
    {
        return $this->_model->where('order_id', $orderId)
            ->select('order_items.id', 'order_items.quantity','order_items.order_id' ,'products.name as product_name')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->get();
    }


    public function updateOrderItem($id, $data)
    {
        // Cập nhật chi tiết đơn hàng bằng ID
        return $this->_model->update($id, $data);
    }

    public function deleteOrderItem($id)
    {
        return $this->_model->where('id', $id)->delete();
    }

}
