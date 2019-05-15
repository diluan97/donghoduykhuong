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
            <a href="{{route('admin_category.create')}}"><button type="submit"class="btn btn-outline-primary">Thêm thương hiệu</button></a>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tên thương hiệu</th>
                    <th>Thông tin</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            @foreach($category as $item)
                 <tr>
                    <td>{{$item->name}}</td>
                    <td>{!! substr($item->description,0,100)!!}...</td>
                    <td>{{$item->status()}}</td>
                    <td>
                        <a href="{{route('admin_category.edit',$item->id)}}"><i class="fa fa-edit" style="font-size:36px"></i></a>
                            <i class="fa fa-trash-o"style="font-size:36px;margin-left:15%" data-toggle="modal" data-target="{{ '#delete' . $item->id }}"></i>
                        <div class="ilv-btn-group">
                            <form action="{{route('admin_category.destroy',$item->id)}}" method="post">

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