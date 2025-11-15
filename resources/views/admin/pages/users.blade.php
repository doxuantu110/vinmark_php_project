@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý người dùng</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm người dùng...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="row">
                            @foreach ($users as $user)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="well profile_view" style="padding: 15px; min-height: 280px;">

                                        <div class="col-sm-12">
                                            <h4 class="brief">
                                                <i><b>{{ $user->role->name ?? 'Không có vai trò' }}</b></i>
                                            </h4>

                                            <div class="left col-md-8 col-sm-8 col-xs-12">
                                                <h2 class="mt-1">{{ $user->name }}</h2>

                                                <p><strong>Email: </strong> {{ $user->email }}</p>

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <i class="fa fa-map-marker"></i>
                                                        {{ $user->address ?? 'Chưa cập nhật' }}
                                                    </li>

                                                    <li>
                                                        <i class="fa fa-phone"></i>
                                                        {{ $user->phone_number ?? 'Chưa cập nhật' }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="right col-md-4 col-sm-4 col-xs-12 text-center">
                                                <img src="{{ asset('storage/' . ($user->avatar ?? 'uploads/users/default-avatar.png')) }}"
                                                    class="img-circle img-responsive"
                                                    style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px;">
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="profile-bottom text-center"
                                            style="margin-top: 15px; display:flex; justify-content:center; gap:8px;">

                                            {{-- 1. CUSTOMER: bật/tắt chặn --}}
                                            @if ($user->role->name === 'customer')
                                                 {{-- Nút nâng cấp thành nhân viên --}}
                                                <form action="#" method="POST"
                                                    style="margin:0;">
                                                    @csrf
                                                    <button class="btn btn-info btn-sm">
                                                        <i class="fa fa-arrow-up"></i> Nhân viên
                                                    </button>
                                                </form>
                                                @if ($user->status === 'banned')
                                                    {{-- Bỏ chặn --}}
                                                    <form action="#"
                                                        method="POST" style="margin:0;">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">
                                                            <i class="fa fa-unlock"></i> Bỏ chặn
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- Chặn --}}
                                                    <form action="#" method="POST"
                                                        style="margin:0;">
                                                        @csrf
                                                        <button class="btn btn-warning btn-sm">
                                                            <i class="fa fa-ban"></i> Chặn
                                                        </button>
                                                    </form>
                                                @endif
                                               
                                                {{-- 2. Xóa hoặc Khôi phục --}}
                                            @if ($user->status === 'deleted')
                                                {{-- Khôi phục --}}
                                                <form action="#" method="POST"
                                                    style="margin:0;">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">
                                                        <i class="fa fa-undo"></i> Khôi phục
                                                    </button>
                                                </form>
                                            @else
                                                {{-- Xóa --}}
                                                <form action="#" method="POST"
                                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa?')" style="margin:0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            @endif
                                            @endif


                                            

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
@endsection
