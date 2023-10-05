<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN ADMIN</title>
  @section('title', 'LOGIN ADMIN')

  <!-- CSS -->
  @include('admins.layouts.css')
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ route('admin.login') }}" class="h1"><b>HOTELIER</b> Login</a>
      </div>
      <div class="card-body">
     
        <form action="{{ route('admin.handle-login') }}" method="post">
          @csrf 

          <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email của bạn đã dăng ký">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
          
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Ghi Nhớ Đăng Nhập
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <br>
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" id='alert_error' role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" id="close_alert_error" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
        <p class="mb-1">
          <a href="forgot-password.html">Bạn quên mật khẩu?</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Tạo tài khoản mới</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- JS -->
  @include('admins.layouts.js')
</body>
</html>
