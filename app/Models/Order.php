<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
{
    return $this->belongsTo(User::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'order_id');
}
protected $fillable = ['user_id','customer_id','status_id','total_amount' ];

}
