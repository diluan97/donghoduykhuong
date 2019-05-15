<?php

namespace App\Http\Controllers\Guest;
use Auth;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryOrderController extends Controller
{
    public function getHistoryOrder(){
        if(Auth::check()){
            $id = Auth::user()->id;
            $order = Order::with('products')->where('user_id',$id)->get();
            // dd($order);
        }else{
            $order = "";
        }
        return view('Guest.historyorder.history_order')->with(['order'=>$order]);
    }
}
