<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ BASE_URL . 'public/css/admin.css' }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        overflow: hidden;
        /* Ngăn chặn cuộn toàn trang */
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: white;
        /* Giữ màu header */
        z-index: 1000;
        /* Đảm bảo header luôn hiển thị trên cùng */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-bar {
        position: fixed;
        top: 60px;
        /* Căn chỉnh với header */
        left: 0;
        width: 200px;
        height: calc(100vh - 60px);
        /* Độ cao bằng chiều cao màn hình trừ header */
        background-color: #343a40;
        padding-top: 40px;
        overflow-y: auto;
        /* Cho phép cuộn menu nếu quá dài */
    }

    .nav-bar li {
        list-style: none;
        padding: 10px 15px;
        transition: 0.3s;
        color: white;
    }

    .nav-bar li a {
        text-decoration: none;
        color: white;
        display: block;
    }

    .nav-bar li:hover {
        background-color: red;
    }

    /* Căn nội dung chính bên phải */
    .main-content {
        margin-left: 200px;
        /* Đẩy nội dung ra sau sidebar */
        padding: 20px;
        margin-top: 70px;
        /* Để không bị che bởi header */
        height: calc(100vh - 70px);
        /* Chiều cao chính xác */
        overflow-y: auto;
        /* Cuộn nội dung khi cần */
    }
</style>

<body>

    <body>
        <div class="header py-3 border-2 border-bottom">
            <h1 style="text-align: center;"><i class="fa-solid fa-house"></i> ADMIN</h1>
        </div>

        <div class="nav-bar">
            <ul>
                <li><a href="{{ route('admin/thong_ke') }}" class="ajax-link"><i class="fa-solid fa-chart-simple"></i>
                        Thống kê</a></li>
                <li><a href="{{ route('admin/danh_muc') }}" class="ajax-link"><i class="fa-solid fa-bars"></i> Danh
                        mục</a></li>
                <li><a href="{{ route('admin/san_pham') }}" class="ajax-link"><i class="fa-solid fa-list"></i> Sản
                        phẩm</a></li>
                <li><a href="{{ route('admin/tai_khoan') }}" class="ajax-link"><i class="fa-solid fa-user"></i> Tài
                        khoản</a></li>
                <li><a href="{{ route('admin/binh_luan') }}" class="ajax-link"><i class="fa-solid fa-comment"></i> Bình
                        luận</a></li>
                <li><a href="{{ route('admin/don_hang') }}" class="ajax-link"><i class="fa-solid fa-cart-shopping"></i>
                        Đơn hàng</a></li>
                <li><a href="{{ route('') }}"><i class="fa-solid fa-user"></i> Về trang user</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div id="content">
                @yield('content')
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
