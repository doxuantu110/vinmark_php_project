@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý người dùng</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">

                    <div class="row">
                        {{-- ⭐ SỬA LỖI: Đổi $user thành $userItem --}}
                        @foreach ($users as $userItem)
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="well profile_view" style="padding: 15px; min-height: 280px;">

                                    <div class="col-sm-12">

                                        <div class="left col-md-8 col-sm-8 col-xs-12">
                                            <h4 class="brief">
                                                <i><b>{{ $userItem->role->name ?? 'Không có vai trò' }}</b></i>
                                            </h4>
                                            
                                            <h2>{{ $userItem->name }}</h2>

                                            <p><strong>Email: </strong> {{ $userItem->email }}</p>

                                            <ul class="list-unstyled">
                                                <li>
                                                    <i class="fa fa-map-marker"></i>
                                                    {{ $userItem->address ?? 'Chưa cập nhật' }}
                                                </li>

                                                <li>
                                                    <i class="fa fa-phone"></i>
                                                    {{ $userItem->phone_number ?? 'Chưa cập nhật' }}
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="right col-md-4 col-sm-4 col-xs-12 text-center">
                                            <img src="{{ asset($userItem->avatar ? 'storage/' . $userItem->avatar : 'storage/uploads/users/default-avatar.png') }}"
                                                class="img-circle img-responsive"
                                                style="width: 100px; height: 100px; object-fit: cover; margin-top: 10px; margin-left: auto; margin-right: auto;">
                                        </div>

                                    </div>

                                    <div class="clearfix"></div>

                                    {{-- Nút hành động --}}
                                    <div class="profile-bottom text-center"
                                        style="margin-top: 15px; display:flex; justify-content:center; gap:8px;">

                                        {{-- ========================================================= --}}
                                        {{-- ================ 1) USER LÀ CUSTOMER ====================== --}}
                                        {{-- ========================================================= --}}
                                        @if ($userItem->role->name === 'customer')
                                            {{-- ⭐ NÂNG CẤP NHÂN VIÊN (Chỉ hiển thị khi đang ACTIVE) --}}
                                            @if ($userItem->status === 'active')
                                                <button class="btn btn-info btn-sm upgradeStaff"
                                                    data-user-id="{{ $userItem->id }}">
                                                    <i class="fa fa-arrow-up"></i> Nhân viên
                                                </button>
                                            @endif

                                            {{-- CASE 1: ĐANG BỊ CHẶN --}}
                                            @if ($userItem->status === 'banned')
                                                <button class="btn btn-success btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="active">
                                                    <i class="fa fa-unlock"></i> Bỏ chặn
                                                </button>

                                                {{-- CASE 2: ĐANG BỊ XÓA --}}
                                            @elseif ($userItem->status === 'deleted')
                                                <button class="btn btn-success btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="active">
                                                    <i class="fa fa-undo"></i> Khôi phục
                                                </button>

                                                {{-- CASE 3: ĐANG ACTIVE --}}
                                            @else
                                                <button class="btn btn-warning btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="banned">
                                                    <i class="fa fa-ban"></i> Chặn
                                                </button>

                                                <button class="btn btn-danger btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="deleted">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
                                            @endif
                                        @endif

                                        {{-- ========================================================= --}}
                                        {{-- ===================== 2) USER LÀ STAFF ================== --}}
                                        {{-- ========================================================= --}}
                                        @if ($userItem->role->name === 'staff')
                                            @if ($userItem->status === 'deleted')
                                                <button class="btn btn-success btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="active">
                                                    <i class="fa fa-undo"></i> Khôi phục
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-sm changeStatus"
                                                    data-user-id="{{ $userItem->id }}" data-status="deleted">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
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
@endsection