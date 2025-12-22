 <div class="col-md-3 left_col">
     <div class="left_col scroll-view">
         <div class="navbar nav_title" style="border: 0;">
             <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Vinmark</span></a>
         </div>

         <div class="clearfix"></div>

         <!-- menu profile quick info -->
         <div class="profile clearfix">
             <div class="profile_pic">
                 <img src="{{ asset('storage/' . $user->avatar) }}" alt="..." class="img-circle profile_img">
             </div>
             <div class="profile_info">
                 <span>Xin Chào</span>
                 <h2>Admin</h2>
             </div>
         </div>
         <!-- /menu profile quick info -->
         <br />

         <!-- sidebar menu -->
         <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
             <div class="menu_section">
                 <h3>Tổng quan</h3>
                 @php
                    $adminUser = Auth::guard('admin')->user();
                 @endphp
                 <ul class="nav side-menu">
                     <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                     @if ($adminUser->role->permissions->contains('name', 'manage_users'))
                        <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Quản lý người dùng</span></a></li>
                     @endif
                     
                      @if ($adminUser->role->permissions->contains('name', 'manage_categories'))
                        <li><a href="javascript:void(0)"><i class="fa fa-lock"></i> Quản lý danh mục<span class="fa fa-chevron-down"></span></a>
                         <ul class="nav child_menu">
                             <li><a href="{{ route('admin.categories.add') }}">Thêm danh mục</a></li>
                             <li><a href="{{ route('admin.categories.index') }}">Danh sách danh mục</a></li>
                         </ul>
                     </li>
                     @endif
                     
                     @if ($adminUser->role->permissions->contains('name', 'manage_products'))
                       <li><a href="javascript:void(0)"><i class="fa fa-table"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
                         <ul class="nav child_menu">
                             <li><a href="{{ route('admin.product.add') }}">Thêm sản phẩm</a></li>
                             <li><a href="{{ route('admin.products.index') }}">Danh sách sản phẩm</a></li>
                         </ul>
                     </li>
                     @endif

                     @if ($adminUser->role->permissions->contains('name', 'manage_orders'))
                       <li><a href="{{ route('admin.orders.index') }}"><i class="fa fa-edit"></i> Quản lý đơn hàng</span></a></li>
                     @endif
                     
                     @if ($adminUser->role->permissions->contains('name', 'manage_contacts'))
                       <li><a href="{{ route('admin.contacts.index') }}"><i class="fa fa-envelope"></i> Quản lý liên hệ</span></a></li>
                     @endif
                 </ul>
             </div>
         </div>
         <!-- /sidebar menu -->

         <!-- /menu footer buttons -->
         <div class="sidebar-footer hidden-small">
             <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin.logout') }}">
                 <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
             </a>
         </div>
         <!-- /menu footer buttons -->
     </div>
 </div>
