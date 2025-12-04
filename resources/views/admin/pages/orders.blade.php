@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <div class="right_col" role="main">

        {{-- Page Title --}}
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý đơn hàng</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel disabled-panel">
                    <div class="x_title">
                        <h2>Danh sách đơn hàng</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh mục <small>Danh sách</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tài khoản</th>
                                            <th>Thông tin người nhận</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái đơn hàng</th>
                                            <th>Trạng thái thanh toán</th>
                                            <th>Chi tiết đơn hàng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#addressShippingModal-{{ $order->id }}">{{ $order->shippingAddress->address }}</a>
                                                </td>
                                                <td>{{ number_format($order->total_price, 0, '.', '.') }} đ</td>
                                                <td class="order-status">
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-warning">Chờ xử lý</span>
                                                    @elseif ($order->status == 'processing')
                                                        <span class="badge bg-info">Đang giao</span>
                                                    @elseif ($order->status == 'completed')
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @elseif ($order->status == 'cancelled')
                                                        <span class="badge bg-danger">Đã hủy</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->payment->status == 'pending')
                                                        <span class="badge bg-secondary">Chưa thanh toán</span>
                                                    @else
                                                        <span class="badge bg-success">Đã thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-info" data-toggle="modal"
                                                        data-target="#orderItemsModal-{{ $order->id }}">
                                                        <i class="fa fa-eye"></i> Xem
                                                    </button>
                                                </td>   
                                                <td>
                                                    <!-- Split button -->
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if ($order->status == 'pending')
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    data-id="{{ $order->id }}">Xác nhận</a>
                                                            @endif
                                                            <a class="dropdown-item" href="{{ route('admin.order-detail', ['id' => $order->id, ]) }}" target="_blank">Xem chi
                                                                tiết</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($orders as $order)
                                    {{-- Modal OrderItems --}}
                                    <div class="modal fade" id="orderItemsModal-{{ $order->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="orderItemsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="orderItemsModalLabel">Chi tiết hóa đơn</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Đơn giá</th>
                                                                <th>Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $index = 1; @endphp
                                                            @foreach ($order->orderItems as $item)
                                                                <tr>
                                                                    <td>{{ $index++ }}</td>
                                                                    <td>{{ $item->product->name }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ number_format($item->price, 0, '.', '.') }} đ
                                                                    </td>
                                                                    <td>{{ number_format($item->quantity * $item->price, 0, '.', '.') }}
                                                                        đ</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($orders as $order)
                                    {{-- Modal Address --}}
                                    <div class="modal fade" id="addressShippingModal-{{ $order->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="addressShippingModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addressShippingModalLabel">Thông tin hóa đơn</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Người nhận: {{ $order->shippingAddress->full_name }}</p>
                                                    <p>Địa chỉ: {{ $order->shippingAddress->address }}</p>
                                                    <p>Thành phố: {{ $order->shippingAddress->city }}</p>
                                                    <p>Số điện thoại: {{ $order->shippingAddress->phone }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
