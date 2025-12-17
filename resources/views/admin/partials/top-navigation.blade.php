<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <nav class="nav navbar-nav">
            <ul class="navbar-right">

                {{-- USER --}}
                <li class="nav-item dropdown" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/admin/images/user.png') }}"
                            alt="">
                        Admin
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            Tài khoản
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                            <i class="fa fa-sign-out pull-right"></i> Log Out
                        </a>
                    </div>
                </li>

                {{-- NOTIFICATIONS --}}
                <li class="nav-item dropdown" style="margin-right: 10px">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa {{ $notifications->count() ? 'fa-bell' : 'fa-bell-o' }}"></i>

                        @if ($notifications->count() > 0)
                            <span class="badge bg-red">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu list-unstyled msg_list" role="menu">
                        @forelse($notifications->take(3) as $noti)
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ url('admin' . $noti->link) }}">
                                    {{-- 1. Cột Hình ảnh --}}
                                    <span class="image">
                                        <img src="{{ asset('assets/admin/images/notification-bell.png') }}"
                                            alt="Notification">
                                    </span>

                                    {{-- 2. Cột Nội dung (Gom hết vào đây) --}}
                                    <span class="message-content">
                                        <span class="title-row">
                                            <span class="name">{{ $noti->title }}</span>
                                            <span class="time">{{ $noti->created_at->diffForHumans() }}</span>
                                        </span>
                                        <span class="message">
                                            {{ $noti->message }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                        @empty
                            <li class="nav-item">
                                <div class="text-center text-muted" style="padding: 10px;">
                                    Không có thông báo mới
                                </div>
                            </li>
                        @endforelse

                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item" href="{{ route('admin.notifications.index') }}">
                                    <strong>Xem tất cả thông báo</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                {{-- MESSAGES --}}
                <li class="nav-item dropdown" style="margin-right: 10px">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        @if ($messages->count() > 0)
                            <span class="badge bg-green">
                                {{ $messages->count() }}
                            </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu list-unstyled msg_list" role="menu">
                        @for ($i = 0; $i < min(3, $messages->count()); $i++)
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    {{-- 1. Cột Hình ảnh --}}
                                    <span class="image">
                                        <img src="{{ asset('assets/admin/images/user.png') }}" alt="Profile Image">
                                    </span>
                                    
                                    {{-- 2. Cột Nội dung --}}
                                    <span class="message-content">
                                        <span class="title-row">
                                            <span class="name">{{ $messages[$i]->full_name }}</span>
                                            <span class="time">{{ $messages[$i]->created_at->diffForHumans() }}</span>
                                        </span>
                                        <span class="message">
                                            {{ $messages[$i]->message }}
                                        </span>
                                    </span>
                                </a>
                            </li>
                        @endfor

                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">
                                    <strong>Xem tất cả tin nhắn</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>