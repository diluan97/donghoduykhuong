<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\PoductOrder;
use App\Http\Controllers\Controller;

class DrashController extends Controller
{
    public function getDrash(){
        $user = User::count();
        $product = Product::whereStatus(1)->count();
        $order = Order::where('order_status','<>','H')->count();
        $order_price = Order::where('order_status','GR')->sum('total'); 
        $orders =Order::orderBy('id','desc')->paginate(5);
        return view('admin/tongquan.index')->with([
            'user' => $user,
            'product' => $product,
            'order' => $order,
            'order_price' => $order_price,
            'orders' => $orders,
        ]);
    }
}
