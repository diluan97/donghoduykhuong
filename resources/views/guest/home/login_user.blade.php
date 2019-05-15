@extends('layouts.guest.master')
@section('content')
<style>

.tabset > input[type="radio"] {
  position: absolute;
  left: -200vw;
}

.tabset .tab-panel {
  display: none;
}

.tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
.tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
.tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
.tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
.tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
.tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
  display: block;
}

/*
 Styling
*/
body {
  font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
  color: #333;
  font-weight: 300;
}

.tabset > label {
  position: relative;
  display: inline-block;
  padding: 15px 15px 25px;
  border: 1px solid transparent;
  border-bottom: 0;
  cursor: pointer;
  font-weight: 600;
}

.tabset > label::after {
  content: "";
  position: absolute;
  left: 15px;
  bottom: 10px;
  width: 22px;
  height: 4px;
  background: #8d8d8d;
}

.tabset > label:hover,
.tabset > input:focus + label {
  color: #06c;
}

.tabset > label:hover::after,
.tabset > input:focus + label::after,
.tabset > input:checked + label::after {
  background: #06c;
}

.tabset > input:checked + label {
  border-color: #ccc;
  border-bottom: 1px solid #fff;
  margin-bottom: -1px;
}

.tab-panel {
  padding: 30px 0;
  border-top: 1px solid #ccc;
}

/*
 Demo purposes only
*/
*,
*:before,
*:after {
  box-sizing: border-box;
}

/* body {
  padding: 10px;
} */

.tabset {
  max-width: 65em;
}
</style>
@if(!(Auth::check()))
<div class="tabset" style="margin-top:100px; margin-left:350px">
    <!-- Tab 1 -->
    <input type="radio" name="tabset" id="tab1" aria-controls="dangnhap" checked>
    <label for="tab1" style="font-family:Verdana">Đăng Nhập</label>
    <!-- Tab 2 -->
    <input type="radio" name="tabset" id="tab2" aria-controls="dangky">
    <label for="tab2" style="font-family:Verdana">Đăng Ký</label>
    <!-- Tab 3 -->
  
      <div class="tab-panels">
      <!-- Dang Nhap -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif  
        <section id="dangnhap" class="tab-panel">

          <form action="{{route('login_client')}}" method="post" class="was-validated">
          @csrf
            <div class="form-group">
              <label for="uname" style="font-family:Verdana">Email</label>
              <input type="text" class="form-control" style="font-family:Verdana"id="name" placeholder="Vui lòng nhập email" name="email" required>
              <!-- <div class="valid-feedback">Được Áp Dụng.</div>
              <div class="invalid-feedback">Vui Lòng Điền Email</div> -->
            </div>
            
            <div class="form-group">
              <label for="pwd" style="font-family:Verdana">Mật khẩu</label>
              <input type="password" class="form-control" style="font-family:Verdana" id="password" placeholder="Vui lòng nhập mật khẩu" name="password" required>
              <!-- <div class="valid-feedback">Được Áp Dụng.</div>
              <div class="invalid-feedback">Vui Lòng Điền Mật Khẩu</div> -->
            </div>
          <button type="submit" style="font-family:Verdana" class="btn btn-primary">Đăng Nhập</button>
        </form>
      </section>

    <!-- Đăng Ký -->



        <section id="dangky" class="tab-panel">
          <form action="{{route('register_client')}}" method="post" class="was-validated">
          @csrf
                <div class="form-group">
                  <label for="uname" style="font-family:Verdana">Họ tên</label>
                  <input type="text" class="form-control"style="font-family:Verdana" id="name" placeholder="Vui lòng nhập họ tên" name="name" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Tên</div> -->
                </div>
                <div class="form-group">
                  <label for="uname" style="font-family:Verdana">Email</label>
                  <input type="text" class="form-control" style="font-family:Verdana" id="name" placeholder="Vui lòng nhập email" name="email" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Email</div> -->
                </div>
                <div class="form-group">
                  <label for="uname" style="font-family:Verdana">Địa Chỉ</label>
                  <input type="text" class="form-control"style="font-family:Verdana"  id="name" placeholder="Vui lòng nhập địa chỉ" name="address" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Địa Chỉ</div> -->
                </div>
                <div class="form-group">
                  <label for="uname" style="font-family:Verdana">Số Điện Thoại</label>
                  <input type="text" class="form-control"style="font-family:Verdana"  placeholder="Vui lòng nhập số điện thoại" name="phone" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Sồ D</div> -->
                </div>
                <div class="form-group">
                  <label for="pwd" style="font-family:Verdana">Mật khẩu</label>
                  <input type="password" class="form-control" style="font-family:Verdana" id="password" placeholder="Vui lòng nhập mật khẩu" name="password" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Mật Khẩu</div> -->
                </div>
                <div class="form-group">
                  <label for="pwd" style="font-family:Verdana">Nhập lại mật khẩu</label>
                  <input type="password" class="form-control" style="font-family:Verdana" id="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" required>
                  <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                  <div class="invalid-feedback">Vui Lòng Điền Lại Mật Khẩu</div> -->
                </div>
                <button type="submit" class="btn btn-primary" style="font-family:Verdana">Đăng Ký</button>
              </form>
        </section>
      </div>
    
</div>

@else
<div class="tabset"style="margin-left:550px; padding-bottom:30px">
    <div class="tab-panels">
    <!-- <h2 style="margin-top:100px"> Thông Tin {{Auth::user()->name}} </h2> -->
    <h2 style="margin-top:100px; margin-bottom:30px; margin-left:60px; font-family:Verdana">Thông Tin Khách Hàng </h2>

        <div class="col-sm-6">
        @if(Session::has('success'))
                          <div class="alert alert-info" role="alert">
                            <span class="invalid-feedback" style="display:block">
                              <strong>{{Session::get('success')}}</strong>
                            </span>
                          </div>
                          @endif()	
          <form action="{{route('edit_user',['id'=> (Auth::user()->id)])}}" method="post" class="was-validated">
            @csrf
                      <div class="form-group">
                        <label for="uname" style="font-family:Verdana" >Họ và tên</label>
                        <input type="text" class="form-control" style="font-family:Verdana" id="name" placeholder="Tên" name="name" value="{{Auth::user()->name}}" required>
                        <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                        <div class="invalid-feedback">Vui Lòng Điền Tên</div> -->
                      </div>
                      <div class="form-group">
                        <label for="uname" style="font-family:Verdana" >Email</label>
                        <input type="text" class="form-control" style="font-family:Verdana" id="name" placeholder="Email" name="email" value="{{Auth::user()->email}}" required>
                        <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                        <div class="invalid-feedback">Vui Lòng Điền Tên</div> -->
                      </div>
                      <div class="form-group">
                        <label for="uname" style="font-family:Verdana">Địa Chỉ</label>
                        <input type="text" class="form-control" style="font-family:Verdana" id="name" placeholder="Địa Chi" name="address" value="{{Auth::user()->address}}" required>
                        <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                        <div class="invalid-feedback">Vui Lòng Điền Tên</div> -->
                      </div>
                      <div class="form-group">
                        <label for="uname" style="font-family:Verdana">Số Điện Thoại</label>
                        <input type="text" class="form-control"style="font-family:Verdana"  placeholder="Số Điện Thoại" name="phone" value="{{Auth::user()->phone}}" required>
                        <!-- <div class="valid-feedback">Được Áp Dụng.</div>
                        <div class="invalid-feedback">Vui Lòng Điền Tên</div> -->
                      </div>
                      <button type="submit" style="margin-left:438px; font-family:Verdana" class="btn btn-outline-primary">Lưu</button>
          </form>
        </div>
    </div>
</div>

@endif




<!-- <div class="row" style="margin-left:10px;margin-top:10%; margin-bottom:10%">
	<div class="col-md-5" style="margin-left:28%">
	<h2 style="margin-left:24%; font-family:Verdana">Đăng nhập</h2></br>
		<form class="checkout-form" action="{{route('login_user')}}" method="post">
		@csrf
			<input  style="font-family:Verdana" type="text" name="name" placeholder="Họ tên">
			@if ($errors->has('name'))
                <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
            @endif
			<input style="font-family:Verdana" type="text" name="email" placeholder="Email">
			@if ($errors->has('email'))
                <p class="help is-danger"style="color:red">{{ $errors->first('email') }}</p>
            @endif
            <input style="font-family:Verdana" type="text" name="phone" placeholder="Số điện thoại">  
            
            <input style="font-family:Verdana" type="text" name="address" placeholder="Địa chỉ">
			@if ($errors->has('address'))
                <p class="help is-danger"style="color:red">{{ $errors->first('address') }}</p>
            @endif
            
			<button class="btn btn-success" type="submit" style="margin-left:80%;width:20%">Đăng nhập</button>	 
                                     					
	</div>
	 	
</div> -->

@endsection