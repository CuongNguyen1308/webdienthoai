<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="{{ BASE_URL . 'public/css/login.css?v=' . time() }}">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">

        <div class="screen">
            <div class="screen__content">
                @if (isset($_SESSION['success_message']))
                    <div class="alert alert-success">
                        {{ $_SESSION['success_message'] }}
                    </div>
                    @php unset($_SESSION['success_message']); @endphp
                @endif
                <form class="login" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" name="email" placeholder="Email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="mat_khau" placeholder="Password">
                    </div>
                    <div>
                        <h6 style="color:red">{{ $thongbao }}</h6>
                    </div>
                    <button class="button login__submit">
                        <span class="button__text" name="btnsubmit">Đăng nhập</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <div class="register-forget opacity">
                        <a href="{{ route('dang_ky') }}">Đăng ký ngay</a>
                    </div>
                </form>
                <div class="social-login">
                    <h3>Đăng nhập</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
    <!-- partial -->

</body>

</html>
