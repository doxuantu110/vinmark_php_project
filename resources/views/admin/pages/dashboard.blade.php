@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">

        {{-- TOP STATS --}}
        <div class="row tile_count">
            <div class="col-md-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Người dùng</span>
                <div class="count">{{ $users->count() }}</div>
            </div>
            <div class="col-md-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-bar-chart"></i> Sản phẩm</span>
                <div class="count">{{ $products->count() }}</div>
            </div>
            <div class="col-md-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-shopping-cart"></i> Đơn hàng</span>
                <div class="count green">{{ $orders->count() }}</div>
            </div>
            <div class="col-md-3 tile_stats_count">
                <span class="count_top"><i class="fa fa-money"></i> Doanh thu</span>
                <div class="count">
                    {{ number_format($orders->sum('total_price'), 0, 0) }}đ
                </div>
            </div>
        </div>

        <br>


        <div class="row">
            <!-- bar chart -->
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Doanh thu theo tháng <small>(VNĐ)</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="graph_bar" style="width:100%; height:280px;"></div>
                        <script>
                            window.monthlyRevenueData = @json($monthlyRevenue);
                        </script>
                    </div>
                </div>
            </div>
            <!-- /bar charts -->


            {{-- CATEGORY CHART --}}
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <div style="display:flex; align-items:flex-start; gap:20px;">

                            {{-- CHART --}}
                            <div style="width:180px; height:180px;">
                                <canvas class="canvasDoughnutCategory" data-labels='@json($chartLabels)'
                                    data-counts='@json($chartCounts)'>
                                </canvas>
                            </div>

                            {{-- LEGEND --}}
                            <div style="flex:1; max-height:220px; overflow-y:auto;">
                                <ul class="list-unstyled">
                                    @php
                                        $colors = [
                                            '#BDC3C7',
                                            '#9B59B6',
                                            '#E74C3C',
                                            '#26B99A',
                                            '#3498DB', 
                                            '#F39C12',
                                            '#1ABC9C',
                                            '#34495E',
                                            '#D35400',
                                            '#2ECC71',
                                            '#F1C40F',
                                            '#8E44AD',
                                            '#C0392B',
                                            '#16A085',
                                            '#2980B9',
                                            '#27AE60',
                                            '#E67E22',
                                            '#7F8C8D',
                                            '#2C3E50',
                                            '#FD79A8',
                                            '#6C5CE7',
                                            '#00CEC9',
                                            '#FF7675',
                                            '#A29BFE',
                                            '#FAB1A0',
                                        ];
                                        $total = array_sum($chartCounts);
                                    @endphp

                                    @foreach ($chartLabels as $index => $label)
                                        <li style="margin-bottom:6px;">
                                            <i class="fa fa-square"
                                                style="color: {{ $colors[$index % count($colors)] }}"></i>
                                            {{ $label }}
                                            <span class="pull-right">
                                                {{ $total > 0 ? round(($chartCounts[$index] / $total) * 100) : 0 }}%
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- TOP PRODUCTS TABLE --}}
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top 3 sản phẩm bán chạy nhất</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Số lượng đã bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProducts as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                                class="image-product">
                                        </td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} vnđ</td>
                                        <td>{{ $item->sold_quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            {{-- NEW ORDERS TABLE --}}
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Đơn đặt hàng mới</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < min(3, $allOrders->count()); $i++)
                                    <tr>
                                        <td scope="row">{{ $allOrders[$i]->id }}</td>
                                        <td>{{ $allOrders[$i]->shippingAddress->full_name }}</td>
                                        <td>{{ number_format($allOrders[$i]->total_price, 0, ',', '.') }} vnđ</td>
                                        <td>
                                            @if ($allOrders[$i]->status == 'pending')
                                                <span class="custom-badge badge badge-warning">Đợi xác nhận</span>
                                            @elseif ($allOrders[$i]->status == 'canceled')
                                                <span class="custom-badge badge badge-danger">Đã hủy</span>
                                            @elseif ($allOrders[$i]->status == 'processing')
                                                <span class="custom-badge badge badge-success">Đang giao</span>
                                            @else
                                                <span class="custom-badge badge badge bg-green">Hoàn thành</span>
                                            @endif
                                        </td>
                                        <td>{{ $allOrders[$i]->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('admin.order-detail', ['id' => $allOrders[$i]->id]) }}"
                                                class="btn btn-primary" target="_blank">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- NEW USERS TABLE --}}
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Danh sách người dùng mới</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < min(4, $users->count()); $i++)
                                    <tr>
                                        <td scope="row">{{ $users[$i]->id }}</td>
                                        <td>{{ $users[$i]->name }}</td>
                                        <td>{{ $users[$i]->email }}</td>
                                        <td>{{ $users[$i]->phone_number }}</td>
                                        <td>
                                            @if ($users[$i]->status == 'banned')
                                                <span class="custom-badge badge badge-warning">Bị chặn</span>
                                            @elseif ($users[$i]->status == 'deleted')
                                                <span class="custom-badge badge badge-danger">Đã xóa</span>
                                            @elseif ($users[$i]->status == 'pending')
                                                <span class="custom-badge badge badge-primary">Đợi kích hoạt</span>
                                            @else
                                                <span class="custom-badge badge badge-success">Đã kích hoạt</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
