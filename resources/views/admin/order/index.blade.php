@extends('layouts.admin.admin')
@section('content')

@if(Session::has('mess'))
<div class="alert alert-info" role="alert">
    <span class="invalid-feedback" style="display:block;">
     <strong>{{ Session::get('mess') }}</strong></span>
</div>
@endif()
<div class="col-md-12" >
    <div class="card">
        <form action="{{route('search_order')}}" method="get">
        @csrf
            <input class="form-control" type="text" placeholder="Tìm kiếm theo khách hàng" aria-label="Search" name="searchorder">
        </form>
        <div class="card-body" >
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Thông tin khách hàng</th>
                    <th>Trạng thái giao hàng</th>
                    <th>Ghi chú</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order as $item)
                 <tr>
                    <td>{{$item->order_number}}</td>
                    <td>
                          <li>{{$item->customer_name}}</li>
                          <li>{{$item->customer_address}}</li>
                          <li>{{$item->customer_phone}}</li>
                          <li>{{$item->customer_email}}</li>
                    </td>
                    <td>{{$item->getOrderStatus()}}</td>  
                    <td>{!! substr($item->note,0,100)!!}...</td>
                    <td>{{$item->total}}</td>
                    <td>
                        <a href="{{route('admin_order.edit',$item->id)}}"><i class="fa fa-edit" style="font-size:36px"></i></a>
                            <i class="fa fa-trash-o"style="font-size:36px;margin-left:15%" data-toggle="modal" data-target="{{ '#delete' . $item->id }}"></i>
                        <div class="ilv-btn-group">
                            <form action="{{route('admin_order.destroy',$item->id)}}" method="post">

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
        <div style="margin-left:50%">{{$order->links()}}</div>
    </div>
</div>


@endsection