@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Quản Lý Đơn Hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.transaction.index')}}"> Transaction</a></li>
            <li class="active"> List</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <h4 style="margin-top: -3px">Tổng số đơn: {{$totalTransactions}}</h4>

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <form class="form-inline">
                        <input type="text" class="form-control" name="id" value="{{Request::get('id')}}" placeholder="ID">
                        <input type="text" class="form-control" name="email" value="{{Request::get('email')}}" placeholder="Email..">
                        <select name="type" id="" class="form-control">
                            <option value="0" >Phân Loại khách</option>
                            <option value="1" {{Request::get('type') == 1 ? "selected = 'selected'" : ''}}>Thành viên</option>
                            <option value="2" {{Request::get('type') == 2 ? "selected = 'selected'" : ''}}>Khách</option>
                        </select>
                        <select name="status" id="" class="form-control">
                            <option value="0">Trạng thái</option>
                            <option value="1" {{Request::get('status') == 1 ? "selected = 'selected'" : ''}}>Tiếp nhận</option>
                            <option value="2" {{Request::get('status') == 2 ? "selected = 'selected'" : ''}}>Đang vận chuyển</option>
                            <option value="3" {{Request::get('status') == 3 ? "selected = 'selected'" : ''}}>Đã bàn giao</option>
                            <option value="-1" {{Request::get('status') == -1 ? "selected = 'selected'" : ''}}>Hủy Bỏ</option>
                        </select>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>Search</button>
                        <button type="submit" name="export" value="true" class="btn btn-adn"><i class="fa fa-save"></i> Export</button>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="padding-left: 60px">Info</th>
                                <th>Money</th>
                                <th>Account</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            @if(isset($transactions))
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->id}}</td>
                                        <td>
                                            <ul>
                                                <li>Name: {{$transaction -> tst_name}}</li>
                                                <li>Email: {{$transaction -> tst_email}}</li>
                                                <li>Phone: {{$transaction -> tst_phone}}</li>
                                                <li>Address: {{$transaction -> tst_address}}</li>
                                                <li>Note: {{$transaction -> tst_note}}</li>
                                            </ul>
                                        </td>
                                        <td>{{number_format($transaction->tst_total_money,0,'.',',')}} đ</td>
                                        <td>
                                            @if($transaction->tst_user_id)
                                                <span class="label label-warning">Thành viên</span>
                                                @else
                                                <span class="label label-default">Khách</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="label label-{{$transaction->getStatus($transaction->tst_status)['class']}}">{{$transaction->getStatus($transaction->tst_status)['name']}}</span>
                                        </td>
                                        <td>{{$transaction->created_at}}</td>

                                        <td>
                                            <a data-id="{{$transaction->id}}" href="{{route('ajax.admin.transaction.detail', $transaction->id)}}" class="js-preview-transaction btn btn-xs btn-info"><i class="fa fa-eye"></i>View</a>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-instagram btn-xs">Action</button>
                                                <button type="button" class="btn btn-instagram btn-xs dropdown-toggle" data-toggle='dropdown' aria-expanded="false" >
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('admin.transaction.delete',$transaction->id)}}" ><i class="fa fa-trash"></i>Delete</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="{{route('admin.get.transaction.action',['process', $transaction->id])}}"><i class="fa fa-ban">Đang Bàn Giao</i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('admin.get.transaction.action',['success', $transaction->id])}}"><i class="fa fa-ban">Đã Bàn Giao</i></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('admin.get.transaction.action',['cancel', $transaction->id])}}"><i class="fa fa-ban">Hủy</i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! $transactions->appends($query)->links() !!}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>

    <div class="modal fade fade" id="modal-preview-transaction">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Chi tiết đơn hàng <b id="idTransaction">#1</b></h4>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body no-padding">

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
