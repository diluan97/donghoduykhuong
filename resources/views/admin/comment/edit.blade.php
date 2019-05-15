@extends('layouts.admin.admin')
@section('content')
<form action="{{route('admin_comment.update',['id'=>$comment->id])}}"method="post" enctype="multipart/form-data">
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
                        <h3 class="text-center">Thông tin bình luận</h3>
                    </div>
                    <hr>
                 
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Tên người đăng</label>
                            <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$comment->user->name}}" disabled>
                        </div>
                         <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Nội dung</label>
                            <textarea  class="ckeditor" name="description" id="" cols="80" rows="10" disabled>{{$comment->content}}</textarea>
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                        </div>
                        <div  class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($comment->status==1) checked @endif  
                                    type="radio" class="custom-control-input" id="defaultGroupExample1" name="status" value="1">
                                    <label class="custom-control-label" for="defaultGroupExample1">Hiển thị trên web</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input @if($comment->status==0) checked @endif 
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