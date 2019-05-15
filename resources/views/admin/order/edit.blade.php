@extends('layouts.admin.admin')
@section('content')
 <div class="col-sm-12">
     <table class="table table-bordered" >
        <h4>Mã đơn hàng: {{$item->order_number}}</h4>
        <thead>
            <tr>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Email</th>
                <th scope="col">Ghi chú</th>
                               
            </tr>
            </thead>
                <tbody>
                    <tr>
                        <td>{{$item->customer_name}}</td>
                        <td>{{$item->customer_address}}</td>
                        <td>{{$item->customer_phone}}</td>
                        <td>{{$item->customer_email}}</td>
                        <td>{{$item->note}}</td>
                                
                    </tr>
                </tbody>
                           
    </table>
</div>
<div class="col-sm-12">
    <table class="table table-bordered">
        <h4>Thông tin đơn hàng </h4>
        <thead>
            <tr>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng cộng</th>
                               
            </tr>
        </thead>
        <tbody>
             @foreach($item->products as $product)
                <tr>
                               
                    <td>{{$product->name}}</td>
                     <td>{{$product->price}}</td>
                     <td>{{$product->pivot->quantity}}</td>
                    <td class="total-col">{{number_format(($product->price)*($product->pivot->quantity))}}</td>
                                   
                </tr>
                                
            @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>Tổng tiền</td>
                    <td>{{number_format($item->total)}} VNĐ</td>
                </tr>
        </tbody> 
                           
    </table>
    <form action="{{route('admin_order.update',['id'=>$item->id])}}" method="post"> 
    <input type="hidden" name="_method" value="PUT"> {!! csrf_field() !!}
    @csrf
        <div class="form-group" style="width:50%">
            <label for="exampleFormControlSelect1">Trạng thái giao hàng</label>
            <select class="form-control" id="exampleFormControlSelect1" name="trangthai" @if($item->order_status=='GR') disabled @endif >
                <option value='N' @if($item->order_status=='N') selected @endif>Đơn hàng mới</option>
                <option  @if($item->order_status=='DG') selected @endif value='DG'>Đơn hàng đang giao</option>
                <option  @if($item->order_status=='GR') selected @endif value='GR'>Đơn hàng đã giao</option>
                <option  @if($item->order_status=='H') selected @endif value='H'>Đơn hàng đã hủy</option>
                        
            </select>
        </div>
        <div>
        @if(!($item->order_status=='GR')) 
        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"style="width:40%">
            <span id="payment-button-amount">Lưu</span>
        </button>
        @endif
        
    </div>
    </form>
    
</div>

@endsection