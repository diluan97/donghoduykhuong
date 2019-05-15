@extends('layouts.guest.master');
@section('content');
<!-- <script>
    function submit(){
		document.form['xoagh'].submit();
	}
</script> -->

<div class="page-area cart-page spad">
		<div class="container">
			<div class="cart-table">
				<table>
					<thead>
						<tr>
							<th class="product-th" style="font-family:Verdana">Sản phẩm</th>
							<th style="font-family:Verdana">Giá</th>
							<th style="font-family:Verdana">Số lượng</th>
							<th style="font-family:Verdana">Thành tiền</th>
						</tr>
					</thead>
					@foreach($carts as $item)
					<tbody>
						<tr>
							<td class="product-col">	
								<div class="pc-title">
									<h4 style="font-family:Verdana; margin-top:-14px">{{$item->name}}</h4>
								</div>
							</td>
							<td class="price-col" style="font-family:Verdana">{{number_format($item->price)}} VNĐ</td>
							<td class="quy-col">
								<div class="quy-input">
									<span></span>
									<input disabled min ="1"value="{{$item->qty}}">
								</div>
							</td>
							<td class="total-col" style="font-family:Verdana">{{number_format(($item->qty)*($item->price))}} VNĐ</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
			<div class="row cart-buttons">
				<div class="col-lg-5 col-md-5">
					<div class="site-btn btn-continue"><a href="{{route('home')}}" style="color:white; font-family:Verdana">Tiếp tục mua hàng</a></div>
				</div>
				<div class="col-lg-7 col-md-7 text-lg-right text-left">
					<!-- <div class="site-btn btn-clear">Xoa</div> -->
						    <!-- <span id="xoagiohang" onClick="this.form['xoa'].submit()"> -->
							    <a href="{{route('delete_cart')}}" class="site-btn btn-line btn-update" style="color:black; font-family:Verdana">Xóa</a>
						     <!-- </span> -->	
					
				
				</div>
			</div>
		</div>
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4 style="font-family:Verdana">Quy định cửa hàng</h4><br>
							<div class="shipping-chooes" >
								<div class="sc-item">
									<input type="radio" name="sc" id="one" disabled>
									<label for="one" style="font-family:Verdana">Giao hàng miễn phí trong vòng 10km trở lại</label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two" disabled>
									<label for="two" style="font-family:Verdana">Được đổi trả trong vòng 5 ngày nếu sản phẩm lỗi</label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three" disabled>
									<label for="three" style="font-family:Verdana">Trong vòng 2 ngày được kiểu khác</label>
								</div>
							</div>
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4 style="font-family:Verdana">Thanh toán</h4>
							<p style="font-family:Verdana">Thông tin cuối cùng</p>
							<ul class="cart-total-card">
								<li style="font-family:Verdana">Trả tiền mặt khi nhận hàng</li>
								<li class="total" style="font-family:Verdana">Thành tiền<span>{{number_format(Cart::subtotal(0,'.', '')) }} VNĐ</span></li>
							</ul>
							<a class="site-btn btn-full" href="{{route('check_out')}}">Đặt hàng</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection