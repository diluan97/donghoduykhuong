@extends('layouts.admin.admin')
@section('content')
<form action="{{route('admin_category.store')}}"method="post" enctype="multipart/form-data">
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
    @endif                           -->
         <div class="card-body">
        <!-- Credit Card -->
            <div id="pay-invoice">
                <div class="card-body">
                    <div class="card-title">
                         <h3 class="text-center">Danh Mục</h3>
                    </div>
                     <hr>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên danh mục</label>
                                <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Mô tả</label>
                                <textarea  class="ckeditor" name="description" id="" cols="80" rows="10">{{old('description')}}</textarea>
                                <!-- <input id="cc-number" name="description" type="tel" class="form-control cc-number identified visa" value="{{old('description')}}" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number"> -->
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                @if ($errors->has('description'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-number"class="control-label mb-1">Hình ảnh</label>
                                <input id="cc-number" name="image" style="height:200%"type="file" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>
                            <!-- <div  class="form-group">   
                                <input id="cc-number" name="status" type="radio"  value="1" >   
                                <label for="cc-number" >Hiển thị trên web</label>
                                
                            </div>
                            <div class="form-group">
                                <input id="cc-number" name="status" style="size:100%"type="radio"  value="0" >
                                <label for="cc-number" >Không hiển thị trên web</label>
                            </div> -->
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
                            </div>
                    </div>
                </div>

            </div>
        </div> <!-- .card -->

    </div>
</form>

@endsection