@extends('layouts.guest.master')
@section('content')
<div class="row" style="margin-left:10px;margin-top:10%; margin-bottom:10%">
	<div class="col-md-5" style="margin-left:28%">
	<h2 style="margin-left:24%; font-family:Verdana">Thông tin khách hàng</h2></br>
		<form class="checkout-form" action="{{route('contact')}}" method="post">
		@csrf
			<input  style="font-family:Verdana" type="text" name="name" placeholder="Họ tên">
			@if ($errors->has('name'))
                <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
            @endif
			<input style="font-family:Verdana" type="text" name="email" placeholder="Địa chỉ email">
			@if ($errors->has('email'))
                <p class="help is-danger"style="color:red">{{ $errors->first('email') }}</p>
            @endif
			<input style="font-family:Verdana" type="text" name="phone" placeholder="Số điện thoại">
			<input  style="font-family:Verdana" type="text" name="subject" placeholder="Chủ đề">  
			@if ($errors->has('subject'))
                <p class="help is-danger"style="color:red">{{ $errors->first('subject') }}</p>
            @endif
			<input  style="font-family:Verdana" type="text" name="message" placeholder="Ghi chú">  
			@if ($errors->has('message'))
                <p class="help is-danger"style="color:red">{{ $errors->first('message') }}</p>
            @endif
			<button class="btn btn-success" type="submit" style="margin-left:80%;width:20%">Gửi</button>
		</form>                          					
	</div>
	 	
</div>
@endsection