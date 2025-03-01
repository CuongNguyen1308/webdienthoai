<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="{{BASE_URL.'public/css/register.css?v='.time()}}">
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="register" action="{{ route('dang_ky') }}" method="post">
                    <div class="register__field">
                        <i class="register__icon fas fa-user"></i>
                        <input type="text" class="register__input" name="name" placeholder="Họ tên" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-envelope"></i>
                        <input type="text" class="register__input" name="email" placeholder="Email" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-lock"></i>
                        <input type="password" class="register__input" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-lock"></i>
                        <input type="password" class="register__input" name="re_password" placeholder="nhập lại mật khẩu" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-phone"></i>
                        <input type="text" class="register__input" name="phone" placeholder="Số điện thoại" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-map-marker-alt"></i>
                        <input type="text" class="register__input" name="address" placeholder="Địa chỉ">
                    </div>
                    <div>
                        <h6 style="color:red">{{$thongbao}}</h6>
                    </div>
                    <button class="button register__submit">
                        <span class="button__text">Đăng ký ngay</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <div class="register-forget opacity">
                        Đã có tài khoản? <a href="{{ route('dang_nhap') }}">Đăng nhập</a>
                    </div>
                </form>
                
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

</html>