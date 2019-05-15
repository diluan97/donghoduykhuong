@extends('layouts.guest.master')
@section('content')
<div class="page-area cart-page spad"style="margin-top:50px">
		<div class="container">
			<form class="checkout-form" action="{{route('thanh_toan')}}" method="post">
                @csrf()
				<div class="row">
					<div class="col-lg-6">
						<h3 class="checkout-title" style="font-family:Verdana">Thông tin thanh toán</h3>
						<div class="row">
							<div class="col-md-12">
								<input type="text" name="customer_name" style="font-family:Verdana" placeholder="Họ tên" @if(Auth::check()) value="{{  Auth::user()->name }}" @endif>
								@if ($errors->has('customer_name'))
                                    <p class="help is-danger" style="color:red; font-family:Verdana" >{{ $errors->first('customer_name') }}</p>
                            	@endif
								<input type="text" name="customer_address" style="font-family:Verdana" placeholder="Địa chỉ" @if(Auth::check()) value="{{  Auth::user()->address }}" @endif>
								@if ($errors->has('customer_address'))
                                    <p class="help is-danger"style="color:red; font-family:Verdana">{{ $errors->first('customer_address') }}</p>
                            	@endif
								<input type="text" name="customer_phone" style="font-family:Verdana" placeholder="Số điện thoại" @if(Auth::check()) value="{{  Auth::user()->phone }}" @endif>
								@if ($errors->has('customer_phone'))
                                    <p class="help is-danger"style="color:red; font-family:Verdana">{{ $errors->first('customer_phone') }}</p>
                            	@endif
                                <input type="text" name="customer_email" style="font-family:Verdana" placeholder="Email Address" @if(Auth::check()) value="{{  Auth::user()->email }}" @endif>
								@if ($errors->has('customer_email'))
                                    <p class="help is-danger"style="color:red; font-family:Verdana">{{ $errors->first('customer_email') }}</p>
                            	@endif
                                <input type="text" name="note" style="font-family:Verdana" placeholder="Ghi chú">
                                
								
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="order-card">
							<div class="order-details">
								<div class="od-warp">
									<h4 class="checkout-title" style="font-family:Verdana">Đơn hàng của bạn</h4>
									<table class="order-table">
										<thead>
											<tr>
                                                <th style="font-family:Verdana">Tên sản phẩm</th>
                                                <th style="font-family:Verdana">Số lượng</th>
												<th style="font-family:Verdana">Giá</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach($checkout as $item)
											<tr>
                                                <td style="font-family:Verdana">{{$item->name}}</td>
                                                <td style="font-family:Verdana; text-align:center">{{$item->qty}}</td>
												<td style="font-family:Verdana">{{$item->price}} VNĐ</td>
											</tr>
                                            @endforeach
										</tbody>
										<tfoot>
											<tr class="order-total">
                                                <th></th>
												<th style="font-family:Verdana">Tổng cộng</th>
												<th style="font-family:Verdana">{{number_format(Cart::subtotal(0,'.', '')) }} VNĐ</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<input type="submit" style="font-family:Verdana" class="site-btn btn-full" name="cod" value="Thanh Toán COD">
							<input type="submit" style="font-family:Verdana" class="site-btn btn-full" name="paypal" value="Thanh Toán PayPal">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection