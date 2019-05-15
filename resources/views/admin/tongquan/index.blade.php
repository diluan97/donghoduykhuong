@extends('layouts.admin.admin')
@section('content')
<div class="content mt-3">



<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            
            <h4 class="mb-0">
                <span class="count">{{$user}}</span>
            </h4>
            <p class="text-light">Khách Hàng Mới</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            
            <h4 class="mb-0">
                <span class="count">{{$product}}</span>
            </h4>
            <p class="text-light">Sản Phẩm</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            
            <h4 class="mb-0">
                <span class="count">{{$order}}</span>
            </h4>
            <p class="text-light">Đơn Hàng Mới</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count">{{ $order_price}}</span>    
            </h4>
            <p class="text-light">Tổng Doanh Thu</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <canvas id="widgetChart4"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-12">
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
            @foreach($orders as $item)
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
                    <td>{{number_format($item->total)}} VND</td>
                    <td>
                        <a href="{{route('admin_order.edit',$item->id)}}"><i class="fa fa-edit" style="font-size:36px"></i></a>
                            <i class="fa fa-trash-o"style="font-size:36px;margin-left:15%;cursor:pointer" data-toggle="modal" data-target="{{ '#delete' . $item->id }}"></i>
                        <div class="ilv-btn-group" >
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
        <div style="margin-left:50%">{{$orders->links()}}</div>
</div>
<!--/.col-->



</div>
@endsection