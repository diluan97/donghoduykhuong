@extends('layouts.guest.master');
@section('content')
<div class="col-sm-12">
  <table class="table" style="margin-top:100px">
    <thead>
      <tr>
        <th scope="col" style="font-family:Verdana">Tổng Tiền Của Bạn</th>
        <th scope="col" style="font-family:Verdana">Tỷ Giá Việt Nam</th>
        <th scope="col" style="font-family:Verdana">Thành Tiền USD</th>
        <th scope="col" style="font-family:Verdana">Số Tiền Phải Trả</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row" style="font-family:Verdana">{{ Cart::subtotal() }} VND</th>
        <td style="font-family:Verdana">{{ $tygia }} VND</td>
        <td style="font-family:Verdana">{{ $usd  }} USD</td>
        <td style="font-family:Verdana">{{ $usd }} USD</td>
      </tr>
      
    </tbody>
  </table>
      <form action="{{route('postPayPal')}}" method="POST">
          @csrf
          <input type="hidden" name="amount" value="{{$usd}}">
              <input class="btn btn-outline-info"style="margin-bottom:200px; font-family:Verdana"type="submit" value="Thanh Toán PayPal">
      </form>
</div>
@endsection