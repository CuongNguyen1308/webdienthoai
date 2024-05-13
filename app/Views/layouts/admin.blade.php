<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{BASE_URL.'public/css/admin.css'}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Đảm bảo chiều cao tối thiểu là 100% của viewport */
    }

    footer {
        margin-top: auto;
        /* Đẩy footer xuống cuối trang */
    }

    .nav-bar li a {
        text-decoration: none;
        color: white;
    }
    .nav-bar li {
        line-height: 50px;
        font-size: large;
        list-style: none;
        padding: 5px 0;
        transition: 0.5s;
    }
    .nav-bar li:hover{
        background-color: red;
    }
</style>

<body style="height: 100%; height: 100%;">
    <div class="header py-3 border-2 border-bottom">
        <h1 style="text-align: center;"><i class="fa-solid fa-house"></i> ADMIN</h1>
    </div>
    <div class="row mt-1" style="height: 210vh;">
        <div class="col-md-2 bg-dark d-block">
            <ul class="nav-bar">
                <li><a href="{{route('admin/thong_ke')}}"><i class="fa-solid fa-chart-simple"></i> Thống kê</a></li>
                <li><a href="{{route('admin/danh_muc')}}"><i class="fa-solid fa-bars"></i> Danh mục</a></li>
                <li><a href="{{route('admin/san_pham')}}"><i class="fa-solid fa-list"></i> Sản phẩm</a></li>
                <li><a href="{{route('admin/tai_khoan')}}"><i class="fa-solid fa-user"></i> Tài khoản</a></li>
                <li><a href="{{route('admin/binh_luan')}}"><i class="fa-solid fa-comment"></i> Bình luận</a></li>
                <li><a href="{{route('admin/don_hang')}}"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a></li>
                <li><a href="{{route('')}}"><i class="fa-solid fa-user"></i> Về trang user</a></li>
            </ul>
        </div>
        <div class="col-md-10 d-block px-5" style="height: 100vh;">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{BASE_URL.'public/css/style.css'}}"></script>
</body>

</html>