@extends('layouts.admin')

@section('title', 'Quản lý liên hệ')

@section('content')
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Hộp thư liên hệ</h3>
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
                            <h2>Hộp thư đến <small>Quản lý phản hồi từ khách hàng</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">

                                {{-- MAIL LIST --}}
                                <div class="col-sm-3 mail_list_column"
                                    style="overflow-y:auto; max-height: 520px; border-right:1px solid #eee; padding-right:0;">

                                    <button id="compose" class="btn btn-success btn-block mb-3" type="button"
                                        style="border-radius:6px; font-weight:600;">
                                        <i class="fa fa-edit"></i> SOẠN TIN MỚI
                                    </button>

                                    @foreach ($contacts as $contact)
                                        <a href="javascript:void(0);" class="contact-item"
                                            data-name="{{ $contact->full_name }}" data-email="{{ $contact->email }}"
                                            data-message="{{ $contact->message }}" data-id="{{ $contact->id }}"
                                            data-is_replyed="{{ $contact->is_replyed }}">

                                            <div class="mail_list p-2"
                                                style="border-bottom:1px solid #f0f0f0; border-radius:6px; transition:0.2s;">

                                                <div class="d-flex align-items-center mb-1">

                                                    {{-- STATUS ICON --}}
                                                    @if ($contact->is_replyed)
                                                        <span id="status-{{ $contact->id }}"
                                                            class="badge bg-success status-text">
                                                            <i class="fa fa-check-circle"></i> Đã phản hồi
                                                        </span>
                                                    @else
                                                        <span id="status-{{ $contact->id }}"
                                                            class="badge bg-danger status-text">
                                                            <i class="fa fa-times-circle"></i> Chưa phản hồi
                                                        </span>
                                                    @endif

                                                </div>

                                                {{-- NAME + TIME --}}
                                                <h4 style="font-size:15px; margin:0; font-weight:600; color:#333;">
                                                    {{ $contact->full_name }}
                                                    <small
                                                        style="display:block; font-size:11px; color:#888; margin-top:2px;">
                                                        {{ $contact->created_at->format('H:i d-m-Y') }}
                                                    </small>
                                                </h4>

                                                {{-- SHORT MESSAGE --}}
                                                <p style="font-size:13px; margin-top:6px; color:#555;">
                                                    {{ Str::limit($contact->message, 60) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                {{-- /MAIL LIST --}}

                                {{-- CONTENT MAIL --}}
                                <div class="col-sm-9 mail_view" style="display:none;">
                                    <div class="inbox-body" style="padding:20px;">

                                        <div class="sender-info pb-2 mb-3" style="border-bottom:1px solid #eee;">
                                            <strong></strong>
                                            <span></span> → <strong>me</strong>
                                        </div>

                                        <div class="view-mail">
                                            <p></p>
                                        </div>

                                        <button id="compose" class="btn btn-primary mt-3" type="button"
                                            style="border-radius:6px;">
                                            <i class="fa fa-reply"></i> Trả lời
                                        </button>

                                    </div>
                                </div>
                                {{-- /CONTENT MAIL --}}

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
