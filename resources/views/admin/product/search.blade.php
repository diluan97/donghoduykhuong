@extends('layouts.admin.admin')
@section('content')

@if(Session::has('mess'))
<div class="alert alert-info" role="alert">
    <span class="invalid-feedback" style="display:block;">
    <strong>{{ Session::get('mess') }}</strong></span>
</div>
 @endif()

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
           <div class="active-cyan-4 mb-4">
               <form action="{{route('search_product')}}" method="get">
                @csrf
                   <input class="form-control" type="text" placeholder="Tìm kiếm theo sản phẩm" aria-label="Search" name="searchproduct">
               </form>
               
            </div>
             <!-- <a href="{{route('admin_product.create')}}"><button type="submit"class="btn btn-outline-primary">Thêm sản phẩm</button></a> -->
            
        </div>
        <div class="card-body">
               <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên sản phẩm</th>
                            <th>Thông tin</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index=1 ?>
                        @foreach($product as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td>{{$item->name}}</td>
                                <td style="width:30%">{{$item->short_description}}</td>
                                <td><img src="{{ asset('image/product/'.$item->image) }}"  style="width:100px;100px" alt=""></td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->status()}}</td>
                                <td>
                                    <a href="{{route('admin_product.edit',$item->id)}}"><i class="fa fa-edit" style="font-size:36px"></i></a>
                                        <i class="fa fa-trash-o"style="font-size:36px;margin-left:15%" data-toggle="modal" data-target="{{ '#delete' . $item->id }}"></i>
                                    <div class="ilv-btn-group">
                                        <form action="{{route('admin_product.destroy',$item->id)}}" method="post">

                                            <input type="hidden" name="_method" value="DELETE">
                                            {!! csrf_field() !!}
                                            <div class="modal fade" id="{{ 'delete' . $item->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content  -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Cảnh báo</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Dữ liệu sẽ bị xóa vĩnh viễn.Bạn có chắc là muốn như vậy?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-danger active">Đồng ý</button>
                                                            <button type="button" class="btn btn-outline-brand active" data-dismiss="modal">Không đồng ý</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
              
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection