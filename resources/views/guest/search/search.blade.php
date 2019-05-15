@extends('layouts.guest.master');
@section('content')
<h3 style="margin-top:100px;margin-bottom:-200px">@if($products->count())<center>Kết qủa tìm kiếm theo @if($searchproduct) 
								tên {{$searchproduct}} 
								@elseif($searchCategory)
								danh mục {{$cate->name}}
								@elseif($price)
								giá tiền	
								@endif</center>@endif</h3>
<h3 style="margin-top:300px;margin-bottom:200px"> @if(!$products->count())<center> Không tìm thấy sản phẩm @if($searchproduct)
								tên {{$searchproduct}} 
								@elseif($searchCategory)
								danh mục {{$cate->name}}
								@elseif($price)
								giá tiền	
								@endif</center>@endif</h3>
@if($products->count()>0)
<section class="product-section spad">
		<div class="container">
        <form action="{{route('add_cart')}}" method='post'>
			<div class="row" id="product-filter">
			<!-- <div class="col-sm-3"></div> -->
			@foreach($products as $item)
			
				<div class="mix col-lg-4 col-md-6 best">
					<div class="product-item">
						<a href="{{route('detail',$item->id)}}">
						<figure>
							<img src="{{asset('image/product/'.$item->image)}}" alt="">
						</figure></a>
						<div class="product-info">
							<h6 style="font-family:Verdana">{{$item->name}}</h6>
							<p style="font-family:Verdana">{{number_format($item->price)}}</p>
							<button  class="btn btn-outline-danger" style="width:200px; font-size:20px" type="submit">THÊM VÀO GIỎ</button>
						</div>	
					</div>
				</div>
		
				@csrf
					<input type="hidden" name="id" value="{{$item->id}}">
					<input type="hidden" name="name" value="{{$item->name}}">
					<input type="hidden" name="image" value="{{$item->image}}">
					<input type="hidden" name="price" value="{{$item->price}}">
					<input type="hidden" name="quantity" value="1">
			
			@endforeach
			</div>
            </form>
		</div>
	</section>
@endif

@endsection