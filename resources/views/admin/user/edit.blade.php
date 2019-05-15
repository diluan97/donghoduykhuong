@extends('layouts.admin.admin')
@section('content')
<form action="{{route('user.update',['id'=>$user->id])}}"method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="PUT"> {!! csrf_field() !!}
@csrf
<div class="col-lg-6">
    <div class="card">
    
         <div class="card-body">
         <!-- Credit Card -->
            <div id="pay-invoice">
                 <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Thông tin người dùng</h3>
                    </div>
                    <hr>
                 
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Tên người dùng</label>
                            <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name',$user->name)}}" disabled>
                        </div>
                        <div  class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($user->role==1) checked @endif  
                                    type="radio" class="custom-control-input" id="defaultGroupExample1" name="role" value="1">
                                    <label class="custom-control-label" for="defaultGroupExample1">Admin</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($user->role==0) checked @endif 
                                    type="radio" class="custom-control-input" id="defaultGroupExample2" name="role" value="0">
                                    <label class="custom-control-label" for="defaultGroupExample2">Khách hàng</label>
                                </div>
                            </div>
                        </div>
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