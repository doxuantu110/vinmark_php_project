@extends('layouts.admin')

@section('title', 'Thông báo')

@section('content')
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Thông báo</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Tìm</button>
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
                            <h2>Thông báo <small>Tất cả thông báo</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                                    <!-- start recent activity -->
                                    <ul class="list-unstyled custom-msg-list">
                                        @forelse ($notifications as $notification)
                                            <li class="msg-item {{ $notification->is_read ? '' : 'unread' }}">
                                                <a href="{{ url('admin' . $notification->link) }}" class="notification-item msg-link"
                                                    data-id="{{ $notification->id }}">

                                                    {{-- 1. Cột Icon Chuông --}}
                                                    <div class="msg-icon">
                                                        <img src="{{ asset('assets/admin/images/notification-bell.png') }}"
                                                            alt="icon">
                                                    </div>

                                                    {{-- 2. Cột Nội dung --}}
                                                    <div class="msg-content">
                                                        {{-- Dòng trên: Tiêu đề + Thời gian --}}
                                                        <div class="msg-header">
                                                            <span class="heading msg-title">{{ $notification->title }}</span>
                                                            <span
                                                                class="msg-time">{{ $notification->created_at->format('h:i A d-m-Y') }}</span>
                                                        </div>

                                                        {{-- Dòng dưới: Dấu gạch + Nội dung --}}
                                                        <div class="msg-desc">
                                                            <span class="separator">|</span>
                                                            {{ Str::limit($notification->message, 80) }}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @empty
                                            <li>
                                                <div class="text-center text-muted p-3">
                                                    Không có thông báo nào
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>

                                    <!-- end recent activity -->
                                </div>
                            </div>
                        </div>

                        {{-- CSS bổ sung cho đẹp --}}
                        <style>
                            .mail_list:hover {
                                background-color: #f8f9ff;
                                cursor: pointer;
                            }

                            .contact-item:hover {
                                text-decoration: none;
                            }
                        </style>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="compose col-md-6">
        <div class="compose-header">
            Phản hồi liên hệ
            <button type="button" class="close compose-close">
                <span>×</span>
            </button>
        </div>

        <div class="compose-body">
            {{-- Khu vực này sẽ được CKEditor thay thế nhờ ID editor-contact --}}
            <div id="editor-contact" class="editor-wrapper" style="min-height: 150px"></div>
        </div>

        <div class="compose-footer">
            {{-- Nút Gửi này khớp với class .send-reply-contact trong đoạn JS trước đó --}}
            <button class="send-reply-contact btn btn-sm btn-success" type="button">Gửi</button>
        </div>
    </div>


@endsection
