@extends('layouts.guest.master')
@section('content')
<div class="col-sm-12" style="margin-top:200px">
@if(count($order)>0)
    @foreach($order as $item)
    <div class="row"style="margin-top:150px">
        <div class="col-sm-4">
            <div class="cart-table">
                        <table>
                            <h4 style="font-family:Verdana">Mã đơn hàng: {{$item->order_number}}</h4>
                            <thead>
                                <tr>
                                    <th class="product-th" style="font-family:Verdana">Tên khách hàng</th>
                                    <th style="font-family:Verdana">{{$item->customer_name}}</th>
                                </tr>
                                <tr>
                                    <th class="product-th" style="font-family:Verdana">Địa chỉ</th>
                                    <th style="font-family:Verdana">{{$item->customer_address}}</th>
                                </tr>
                                <tr>
                                    <th class="product-th" style="font-family:Verdana">Số điện thoại</th>
                                    <th style="font-family:Verdana">{{$item->customer_phone}}</th>
                                </tr>
                                <tr>
                                    <th class="product-th" style="font-family:Verdana">Email</th>
                                    <th style="font-family:Verdana">{{$item->customer_email}}</th>
                                </tr>
                                <tr>
                                    <th class="product-th" style="font-family:Verdana">Ghi chú</th>
                                    <th style="font-family:Verdana">{{$item->note}}</th>
                                </tr>
                            
                            </thead>
                        </table>
                    </div>
        </div>
        <div class="col-sm-8">
        <div class="cart-table">
                    <table>
                        <h4 style="font-family:Verdana">Thông tin đơn hàng - Tổng tiền: {{number_format($item->total)}} VNĐ</h4>
                        <thead>
                            <tr>
                                <th class="product-th" style="font-family:Verdana">Sản phẩm</th>
                                <th style="font-family:Verdana">Giá</th>
                                <th style="font-family:Verdana">Số lượng</th>
                                <th style="font-family:Verdana">Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->products as $product)
                            <tr>
                                <td class="product-col">
                                    <img src="img/product/cart.jpg" alt="">
                                    <div class="pc-title">
                                        <h4 style="font-family:Verdana;margin-top: -30px">{{$product->name}}</h4>

                                    </div>
                                </td>
                                <td class="price-col" style="font-family:Verdana">{{$product->price}}</td>
                                <td class="quy-col">
                                <div style="margin-left:162px">
                                        <span style="font-family:Verdana">{{$product->pivot->quantity}}</span>
                                        
                                    </div>
                                </td>
                                <td class="total-col" style="font-family:Verdana">{{number_format(($product->price)*($product->pivot->quantity))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    @endforeach
@else
   <h1 style="margin-left:400px; padding-bottom:300px">Bạn chưa có đơn hàng nào</h1>
@endif
</div>
@endsection