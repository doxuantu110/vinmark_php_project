<!DOCTYPE html>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập Quản trị viên</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('assets/admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/admin/build/css/custom.min.css') }}" rel="stylesheet">

</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="{{ route('admin.login.post') }}" method="POST">
                        @csrf
                        <h1>Đăng nhập Quản trị</h1>
                        <div>
                            <input type="text" class="form-control" name="email" placeholder="Tên đăng nhập"
                                required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                                required />
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit">Đăng nhập</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> Vinmark </h1>
                                <p>©2025 Bản quyền thuộc về Vinmark. Chính sách
                                    bảo mật và điều khoản.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
