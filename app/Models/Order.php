<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;
    protected $fillable=[
        'order_number',
        'note',
        'total',
        'customer_address',
        'order_status',
        'customer_name',
        'customer_phone',
        'customer_email',
        'order_status',
        'type_checkout'
    ];
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','product_order')->withPivot('quantity');
    }
    public function productOrders()
    {
        return $this->hasMany('App\Models\ProductOrder');
    } 
    public function getOrderStatus()
    {
        if($this->order_status=='N'){
            echo 'Đơn hàng mới';
        }elseif($this->order_status=='DG'){
            echo'Đơn hàng đang giao';
        }elseif($this->order_status=='GR'){
            echo'Đơn hàng đã giao';
        }elseif($this->order_status=='H'){
            echo'Đơn hàng đã hủy';
        }
    }
}
