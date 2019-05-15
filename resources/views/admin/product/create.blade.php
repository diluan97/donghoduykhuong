@extends('layouts.admin.admin')
@section('content')
<form action="{{route('admin_product.store')}}" method="post" enctype="multipart/form-data">
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
    @endif     -->
        <div class="card-body">
        <!-- Credit Card -->
             <div id="pay-invoice">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Sản phẩm</h3>
                    </div>
                    <hr>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Danh Mục </label>
                                <select class="form-control" name="category_id" >
                                 @foreach($categories as $item )
                                     <option  value="{{$item->id}}">{{$item->name}}</option>
                                 @endforeach
                                 </select>
                                @if ($errors->has('hot'))
                                    <div class="alert alert-success" role="alert">
                                        <span class="invalid-feedback" style="display:block;">
                                        <strong>{{ $errors->first('hot') }}</strong></span>
                                        </div>
                                @endif
                             </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
                                <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Thông tin</label>
                                <textarea  class="ckeditor" name="short_description" id="" cols="80" rows="10">{{old('short_description')}}</textarea>
                                @if ($errors->has('short_description'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('short_description') }}</p>
                                @endif
                                <!-- <input id="cc-pament" name="short_description" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('short_description')}}"> -->
                            </div>                       
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Hình ảnh</label>
                                <input style="height:45px"id="cc-number" name="image" type="file" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>

                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Số lượng</label>
                                <input id="cc-number" name="quantity" type="number" class="form-control cc-number identified visa" value="{{old('quantity')}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                @if ($errors->has('quantity'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('quantity') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Giá</label>
                                <input id="cc-number" name="price" type="number" class="form-control cc-number identified visa" value="{{old('price')}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                @if ($errors->has('price'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('price') }}</p>
                                @endif
                            </div>
                            <div  class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="status" value="1">
                                    <label class="custom-control-label" for="defaultGroupExample1">Hiển thị trên web</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="status" value="0">
                                    <label class="custom-control-label" for="defaultGroupExample2">Không hiển thị trên web</label>
                                </div>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Lưu</span>
                                </button>
                            </div><br>
                            
                            <!-- <div>
                                <button style="width:40%; margin-left:50%;margin-top:-20%"id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"name="hienthi">
                                    <span id="payment-button-amount">Hiển thị</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div> -->

                    </div>
                </div>

            </div>
        </div> <!-- .card -->

    </div>
</form>

@endsection