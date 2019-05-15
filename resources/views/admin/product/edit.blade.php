@extends('layouts.admin.admin')
@section('content')
<form action="{{route('admin_product.update',['id'=>$product->id])}}"method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="PUT"> {!! csrf_field() !!}
@csrf
<div class="col-lg-6">
    <div class="card">
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif                          -->
        <div class="card-body">
         <!-- Credit Card -->
            <div id="pay-invoice">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Sản phẩm</h3>
                    </div>
                    <hr>
                    <form action="" method="post" novalidate="novalidate">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
                            <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name',$product->name)}}">
                            @if ($errors->has('name'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Thông tin</label>
                            <textarea  class="ckeditor" name="short_description" id="" cols="80" rows="10">{{old('short_description',$product->short_description)}}</textarea>
                            <!-- <input id="cc-number" name="short_description" type="tel" class="form-control cc-number identified visa" value="{{old('short_description',$product->short_description)}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number"> -->
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            @if ($errors->has('short_description'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('short_description') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Hình ảnh</label>
                            <input id="cc-number" name="image" type="file" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            @if(!empty($product->image) && $product->image != '')
                                 <img src="{{ asset('image/product/'.$product->image) }}" alt="" style="width:200px;200px">
                             @endif
                            @if($errors->has('image'))
                                <div class="alert alert-success" role="alert">
                                    <span class="invalid-feedback" style="display:block;">
                                    <strong>{{ $errors->first('image') }}</strong></span>
                                </div>
                             @endif
                        </div>
                                                
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Số lượng</label>
                            <input id="cc-number" name="quantity" type="number" class="form-control cc-number identified visa" value="{{old('quantity',$product->quantity)}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            @if ($errors->has('quantity'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('quantity') }}</p>
                            @endif
                        </div>
                            
                         <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Giá</label>
                            <input id="cc-number" name="price" type="number" class="form-control cc-number identified visa" value="{{old('price',$product->price)}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            @if ($errors->has('price'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('price') }}</p>
                            @endif
                        </div>
                        <div  class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($product->status==1) checked @endif 
                                    type="radio" class="custom-control-input" id="defaultGroupExample1" name="status" value="1">
                                    <label class="custom-control-label" for="defaultGroupExample1">Hiển thị trên web</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($product->status==0) checked @endif 
                                    type="radio" class="custom-control-input" id="defaultGroupExample2" name="status" value="0">
                                    <label class="custom-control-label" for="defaultGroupExample2">Không hiển thị trên web</label>
                                </div>
                            </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Lưu</span>
                            </button>
                        </div>
                        <!-- <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"name="hienthi">
                                 <span id="payment-button-amount">Hiển thị</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                             </button>
                        </div> -->
                     </form>
                </div>
             </div>
        </div>
    </div> <!-- .card -->
 </div>
</form>

@endsection