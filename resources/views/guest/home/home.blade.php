<script>
	function submit(){
		$('#cate').submit();
	}
	function submit(){
		$('#price').submit();
	}
</script>
@extends('layouts.guest.master');
<section class="hero-section set-bg" data-setbg="img/bg.jpg">
				<div class="hero-slider owl-carousel">
				@foreach($slides as $item) 
					<div class="hs-item">
						<div class="hs-left"><img src="{{asset('image/slide/'.$item->image)}}" alt=""></div>
						<div class="hs-right">
							<div class="hs-content">
								<h2><span style="font-family:Verdana"s>2019</span> <br>{{$item->name}}</h2>
								<a href="" class="site-btn">Shop NOW!</a>
							</div>	
						</div>
					</div>
				@endforeach
				</div>
	</section>
@section('content')

<div class="row" style="margin-left:10px">
	<div class="col-sm-3" style="margin-top:5%;height:50%">
	<!-- <h4> <center>Tìm kiếm</center></h4> -->
		<form action="{{route('search')}}" method="get">
		@csrf
			<div class="input-group mb-3" >
				<input type="text" class="form-control" placeholder="Nhập tên sản phẩm" aria-label="Recipient's username" aria-describedby="basic-addon2" name="searchproduct">
				<div class="input-group-append">
					<button class="input-group-text" id="basic-addon2" type="submit"><i class="fa fa-search"></i></button>
				</div>
			</div>
			<h4 style="margin-top:4px; color:black; font-family:Verdana">Thương hiệu</h4>
		@foreach($categories as $item)	
			<ul class="radio" style="margin-left:20px; margin-top:5px"> 
				<input type="radio" name="searchCategory" id="cate" value="{{$item->id}}" onclick="submit()" />&nbsp<label for="crust1">{{$item->name}}</label>
			</ul>
		@endforeach
		<h4 style="margin-top:4px;font-family:Verdana">Lọc theo giá</h4>
			<ul class="radio" style="margin-left:20px; margin-top:10px"> 
				<input type="radio" name="searchPrice" id="price" value="1" onclick="submit()" />&nbsp<label for="crust1">1.000.000 - 5.000.000</label></br>
				<input type="radio" name="searchPrice" id="price" value="2" onclick="submit()" />&nbsp<label for="crust1">5.000.000 - 10.000.000</label></br> 
				<input type="radio" name="searchPrice" id="price" value="3" onclick="submit()" />&nbsp<label for="crust1">10.000.000 - 20.000.000</label></br>
				<input type="radio" name="searchPrice" id="price" value="4" onclick="submit()" />&nbsp<label for="crust1">20.000.000 - 40.000.000</label></br> 
			</ul> 
		</form>
    </div>

	<div class="col-sm-9">
		<section class="product-section spad">
			<div class="container">
				<!-- <ul class="product-filter controls">
					<li class="control" data-filter=".new">New arrivals</li>
					<li class="control" data-filter="all">Recommended</li>
					<li class="control" data-filter=".best">Best sellers</li>
				</ul> -->
				
				
				<div class="row" id="product-filter">
				<!-- <div class="col-sm-3"></div> -->
				@foreach($products as $item)
				
					<div class="mix col-lg-4 col-md-6 best">
						<div class="product-item">
							<a href="{{route('detail',$item->id)}}">
							<figure>
								<img src="{{asset('image/product/'.$item->image)}}" alt="">
							</figure></a>
							<form action="{{route('add_cart')}}" method='post'>
							@csrf
							<input type="hidden" name="id" value="{{$item->id}}">
						<input type="hidden" name="name" value="{{$item->name}}">
						<input type="hidden" name="image" value="{{$item->image}}">
						<input type="hidden" name="price" value="{{$item->price}}">
						<input type="hidden" name="quantity" value="1">
							<div class="product-info">
								<h6 style="font-family:Verdana">{{$item->name}}</h6>
								<p style="font-family:Verdana">{{number_format($item->price)}}</p>
								<button class="btn btn-outline-danger" style="width:200px;font-size:20px" type="submit">THÊM VÀO GIỎ</button>
							</div>	
				</form>
							
						</div>
					</div>
			
						
				
				@endforeach
				</div>
				<div style="margin-left:480px">{{$products->links()}}</div>
			</div>
		</section>
	</div>
</div>
@endsection