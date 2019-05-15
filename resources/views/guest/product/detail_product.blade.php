@extends('layouts.guest.master');
@section('content')
@include('guest.product.component.input')
<div class="page-area product-page spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<figure>
						<img class="product-big-img" src="{{asset('image/product/'.$detail->image)}}" alt="">
					</figure>
					<div class="product-thumbs">
						<div class="product-thumbs-track">
							<div class="pt" data-imgbigurl="img/product/1.jpg"><img src=""alt=""></div>
							
						</div>
					</div>
				</div>
				
				<div class="col-lg-6">
				<form action="{{route('add_cart')}}" method="post">
				@csrf
					<div class="product-content">
						<h2 style="font-family:Verdana">{{$detail->name}}</h2>
						<div class="pc-meta">
							<h4 class="price"style="font-family:Verdana">{{number_format($detail->price)}}</h4>
							<div class="review">
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
								<span>(2 reviews)</span>
							</div>
						</div>
						<p style="font-family:Verdana">{{$detail->short_description}}</p>
							<input type="hidden" name="id" value="{{$detail->id}}">
							<input type="hidden" name="name" value="{{$detail->name}}">
							<input type="hidden" name="image" value="{{$detail->image}}">
							<input type="hidden" name="price" value="{{$detail->price}}">
							<!-- <input type="number" min="1" max="9" name="quantity" patten="[0-9]" value="1"><br><br> -->

						
						<div class="input-group" style="width:40%; padding-bottom:10px">
							<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity">
									<span class="glyphicon glyphicon-minus"><i class="fa fa-minus" style="font-size:24px"></i></span>
								</button>
							</span>
							<input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="{{$detail->quantity}}" >
							<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity">
									<span class="glyphicon glyphicon-plus"><i class="fa fa-plus" style="font-size:24px"></i></span>
								</button>
							</span>
						</div>
						
						<button class="btn btn-outline-danger" style="width:220px; font-size:20px" type="submit">THÊM VÀO GIỎ</button>
					</div>
					</form>
				</div>
			</div>
			
			<div class="product-details">
				<div class="row">
				<h2 style="margin-top:-50px; margin-left:395px;font-family:Verdana">Đánh giá của khách hàng</h2>
			
					@foreach($comment as $item) 
						<div class="row" style="margin-top:10px;margin-left:1%;background-color: #F3EFED; width:100%;border-radius:10px">
							<ul>
								<ol><h4>{{$item->user->name}}: <span style="font-size:20px; font-family:Verdana">{{$item->content}}</span></h4></ol>
								<ol style="font-family:Verdana">{{$item->created_at->diffForHumans()}}</ol>	
								
								@if(Auth::check())
								<ol class="chinhsua{{$item->id}}" style="cursor:pointer; font-family:Verdana">Chỉnh sửa</ol>
								<form action="{{route('delete_comment',['id'=>$item->id])}}" method="post">
								@csrf
									<button class="btn btn-outline-dark" style="font-family:Verdana" type="submit">Xóa</button>
								</form> 
								@endif
							
							</ul>	
						</div>
							@if(Auth::check()) 
							
								<form class="edit{{$item->id}}" style="display:none" action="{{route('edit_comment',['id'=>$item->id])}}" method="post">
								@csrf
									<input class="form-control" style="margin-left: 16px; width: 1100px;margin-top: 10px"type="text" name="content">
									<button class="btn btn-outline-primary" style="margin-left: 1125px;margin-top: -40px" type="submit">Lưu</button>
								</form>	
							 	@include('guest.product.component.edit')
							@endif
						@endforeach
				<div>{{$comment->links()}}</div>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<ul class="nav" role="tablist">
							<li class="nav-item">	
							<!-- @if(Session::has('success'))
									<div class="alert alert-info" role="alert">
										<span class="invalid-feedback" style="display:block">
											<strong>{{Session::get('success')}}</strong>
										</span>
									</div>
									@endif()	 -->
								<a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Bình luận</a>
							</li>
						</ul>
						<form action="{{route('comment')}}" method="post">
						@csrf
							<div class="tab-content">
								<!-- single tab content -->
								<div class="row" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
									<input type="hidden" value="{{$detail->id}}" name="product_id">
									@if(Auth::check()) 
									<input style="width:90%"type="text" class="form-control" name="content"> 
									<button type="submit" class="btn btn-success" style="font-family:Verdana; margin-left:5px">Đăng</button>							
									@else <h3 style="margin-left:288px; font-family:Verdana">Vui lòng đăng nhập để bình luận</h3>
									
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- <div class="text-center rp-title">
				<h5>Related products</h5>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="product-item">
						<figure>
							<img src="img/products/1.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Long red Shirt</h6>
							<p>$39.90</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="product-item">
						<figure>
							<img src="img/products/2.jpg" alt="">
							<div class="bache">NEW</div>
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Hype grey shirt</h6>
							<p>$19.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="product-item">
						<figure>
							<img src="img/products/3.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>long sleeve jacket</h6>
							<p>$59.90</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="product-item">
						<figure>
							<img src="img/products/4.jpg" alt="">
							<div class="bache sale">SALE</div>
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Denim men shirt</h6>
							<p>$32.20 <span>RRP 64.40</span></p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div> 
@endsection