<?php

namespace App\Http\Controllers\Guest;
use Cart;
use Validator;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function delCart(){
        Cart::destroy();
        return redirect()->back();
    }
    public function cart_detail()
    {
        $cartItem = Cart::content();
        return view('Guest.cart.detail_cart')->with(['carts'=>$cartItem]);
    }
    public function purchaseCart(Request $request)
    {
        Cart::add([
            'id' => $request->id, 
            'name' => $request->name, 
            'qty'=> $request->quantity, 
            'price'=> $request->price, 
            'options' => [
                'image' => $request->image],
                ]);
        return redirect()->route('cart');
    }
    public function checkOut(){
        $checkout= Cart::content();
        return view('guest.checkout_success.check_out')->with(['checkout'=>$checkout]);
    }
    public function postCheckOut(Request $request){
      $check=[
          'customer_name' => 'required',
          'customer_address' => 'required|max:50',
          'customer_phone' => 'required|max:10',
          'customer_email'=> 'required|email',
      ];
      $mess=[
          'customer_name.required'=>'Vui lòng nhập tên',
          'customer_address.required'=>'Vui lòng nhập địa chỉ',
          'customer_phone.required'=>'Vui lòng nhập số điện thoại',
          'customer_phone.max'=>'Vui lòng nhập đủ 10 số',
          'customer_email.required'=>'Vui lòng nhập email',
          'customer_email.email'=>'Vui lòng nhập đúng định dạng email',

      ];
      $validator = Validator::make($request->all() , $check, $mess);
      if ($validator->fails()){
          return redirect()->route('check_out')->withError($validator)->withInput();
      }else{
          $order = new Order;
                $order->order_number = 'TMDT_MaHD'. rand(0,10000);
                $order->total = str_replace(',', '', Cart::subtotal());
                $order->customer_name=$request->customer_name;
                $order->customer_address=$request->customer_address;
                $order->customer_phone=$request->customer_phone;
                $order->customer_email=$request->customer_email;
                $order->note = $request->note;
                $order->order_status = 'N';
                if($request->cod){
                    $order->type_checkout = "COD";
                    $order->save();
                }
                if($request->paypal){
                    $order->type_checkout = "PAYPAL";
                    $order->save();
                }
                if(Auth::check()==true){
                    $order->user_id = Auth::user()->id;
                }else{
                    $order->user_id = null;
                }
                $order->save();
                $cartInfor = Cart::content();
                if(count($cartInfor)>0){
                    $arr_id = [];
                    foreach ($cartInfor as $key => $item){
                        $array[$key]=[
                            'order_id' => $order->id,
                            'product_id' => $item->id,
                            'quantity' => $item->qty,
                        ];
                        $order->products()->sync($array);
                    }
                }
                if($request->cod){
                    Cart::destroy();
                    return redirect()->route('home');
                    
                }
                if($request->paypal){
                    return redirect()->route('getPayPal');
                }
                
      }
    }
 
}
