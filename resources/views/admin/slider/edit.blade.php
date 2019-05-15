@extends('layouts.admin.admin')
@section('content')
<form action="{{route('admin_slide.update',['id'=>$slide->id])}}" method="post" enctype="multipart/form-data">
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
    @endif     -->
         <div class="card-body">
         <!-- Credit Card -->
            <div id="pay-invoice">
                 <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Slide</h3>
                    </div>
                    <hr>

                    <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Tên</label>
                            <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name',$slide->name)}}">
                            @if ($errors->has('name'))
                                    <p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Hình ảnh</label>
                            <input id="cc-number" name="image" type="file" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            @if(!empty($slide->image) && $slide->image != '')
                                <img src="{{ asset('image/slide/'.$slide->image) }}" alt="" style="width:200px;200px">
                            @endif
                            @if($errors->has('image'))
                            <div class="alert alert-success" role="alert">
                                <span class="invalid-feedback" style="display:block;">
                                <strong>{{ $errors->first('image') }}</strong></span>
                            </div>
                            @endif
                        </div>
                        <div  class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($slide->status==1) checked @endif 
                                    type="radio" class="custom-control-input" id="defaultGroupExample1" name="status" value="1">
                                    <label class="custom-control-label" for="defaultGroupExample1">Hiển thị trên web</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($slide->status==0) checked @endif
                                    type="radio" class="custom-control-input" id="defaultGroupExample2" name="status" value="0">
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