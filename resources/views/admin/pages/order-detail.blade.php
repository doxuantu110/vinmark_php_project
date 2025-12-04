@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hóa đơn</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Chi tiết hóa đơn <small>Xem thông tin đơn hàng</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Cài đặt 1</a>
                                        <a class="dropdown-item" href="#">Cài đặt 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <section class="content invoice">
                                <!-- title row -->
                                <div class="row">
                                    <div class="invoice-header">
                                        <h1>
                                            <i class="fa fa-globe"></i> Hóa đơn
                                            <small class="pull-right">Ngày tạo: {{ $order->created_at }}</small>
                                        </h1>
                                    </div>
                                </div>

                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Từ
                                        <address>
                                            <strong>Vinmark</strong>
                                            <br>Linh Trung
                                            <br>Thủ Đức, TP.HCM
                                            <br>Số điện thoại: 84 (804) 123-9876
                                            <br>Email: vinmark@gmail.com
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        Đến
                                        <address>
                                            <strong>{{ $order->shippingAddress->full_name }}</strong>
                                            <br>{{ $order->shippingAddress->address }}
                                            <br>{{ $order->shippingAddress->city }}
                                            <br>Số điện thoại: {{ $order->shippingAddress->phone }}
                                        </address>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã đơn hàng: #{{ $order->id }}</b><br>
                                        <b>Email:</b> {{ $order->user->email }} <br>
                                        <b>Tài khoản:</b> {{ $order->user->name }}
                                    </div>
                                </div>

                                <!-- Table row -->
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Ảnh</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>
                                                            <img src="{{ $item->product->image_url }}"
                                                                alt="{{ $item->product->name }}" width="50">
                                                        </td>
                                                        <td>{{ number_format($item->price, 0, '.', '.') }} đ</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->price * $item->quantity, 0, '.', '.') }}
                                                            đ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Payment + totals -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="lead">Phương thức thanh toán</p>

                                        @if ($order->payment->payment_method == 'momo')
                                            <img src="{{ asset('assets/admin/images/momo.png') }}" alt="Momo">
                                        @elseif ($order->payment->payment_method == 'cash')
                                            <img src="{{ asset('assets/admin/images/cash_delivery.png') }}" alt="COD">
                                        @else
                                            <img src="{{ asset('assets/admin/images/paypal.png') }}" alt="Paypal">
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Tiền hàng:</th>
                                                        <td>{{ number_format($order->total_price - 25000, 0, ',', '.') }} đ
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phí vận chuyển:</th>
                                                        <td>{{ number_format(25000, 0, ',', '.') }} đ</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tổng cộng:</th>
                                                        <td><strong>{{ number_format($order->total_price, 0, ',', '.') }}
                                                                đ</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="row no-print">
                                    <div class="col-xs-12 mt-2">

                                        <button class="btn btn-default" onclick="window.print();">
                                            <i class="fa fa-print"></i> In hóa đơn
                                        </button>

                                        @if ($order->status != 'cancelled')
                                            <button class="btn btn-success pull-right send-invoice-mail"
                                                data-id="{{ $order->id }}">
                                                <i class="fa fa-send"></i> Gửi hóa đơn
                                            </button>

                                            @if ($order->status == 'pending')
                                                <button class="btn btn-danger pull-right cancel-order"
                                                    style="margin-right: 5px;" data-id="{{ $order->id }}">
                                                    <i class="fa fa-remove"></i> Hủy đơn hàng
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-danger" style="cursor: not-allowed">
                                                <i class="fa fa-info"></i> Đơn hàng đã hủy
                                            </button>
                                        @endif
                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
