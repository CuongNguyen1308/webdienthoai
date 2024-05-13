<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? '' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{BASE_URL.'public/css/user.css?v='.time()}}">
    <link rel="stylesheet" href="{{BASE_URL.'public/css/app.css?v='.time()}}">
    <link rel="stylesheet" href="{{BASE_URL.'public/css/owl.carousel.min.css'}}">
    <link rel="stylesheet" href="{{BASE_URL.'public/css/owl.theme.default.min.css'}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <div class="row py-4">
                <div class="col-md-3">
                    <a href="{{route('')}}"><img src="{{BASE_URL}}public/img/WORLD.png" class="img-fruid" alt="" style="height: 70px;"></a>
                </div>
                <div class="col-md-4 mt-2">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Từ khóa tìm kiếm" aria-label="Từ khóa tìm kiếm" id="tim_kiem" name="tim_kiem" aria-describedby="basic-addon2" value="<?php
                                                                                                                                                                                                        if (isset($_POST['tim_kiem'])) {
                                                                                                                                                                                                            echo $_POST['tim_kiem'];
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>">

                            <button class="input-group-text" id="basic-addon2" name="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>

                    </form>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-3 fs-2"><i class="fa-solid fa-phone" style="color: #005eff;"></i></div>
                                <div class="col-9">
                                    <h6>Tư vấn hỗ trợ</h6>
                                    <p class="text-info">098842299</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-3 fs-2"><i class="fa-solid fa-user"></i></div>
                                <div class="col-9">
                                    <h6>Xin chào</h6>
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        echo "<a href=".route('acount')." class='text-danger'>" . $_SESSION['user']['ho_ten'] . "</a>";
                                    } else {
                                        echo "<a href=".route("login")." class='text-danger'>Đăng nhập</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="row">
                        <div class="col">
                            <a href="?act=gio-hang" class=" position-relative">
                                <span class="fs-2"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></span>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <span id="totalProduct">
                                        <?= !empty($_SESSION['login']) ? dem_so_luong($_SESSION['login']['id_user'])['sp_gh'] : 0 ?></span>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <nav class="mymainmenu bg-danger">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 border-end" style="align-items: center; display: flex;">
                        <a class="navbar-brand text-white" href="sanpham.html"></a>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i> Danh mục sản phẩm
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <?php
                                    foreach ($danhmuc as $key => $value) {
                                        if ($value['id_dm'] != 0) {
                                    ?>
                                            <li><a class="dropdown-item" href="?act=san-pham&id_dm=<?= $value['id_dm'] ?>"><?= $value['ten_dm'] ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <nav class="navbar navbar-expand-lg bg-body-danger">
                            <div class="container-fluid">
                                <a class="navbar-brand text-white" href="{{route('')}}"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="{{route('san_pham')}}">Sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="?act=tin-tuc">Tin tức</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="?act=gioi-thieu">Giới thiệu</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="?act=lien-he">Liên hệ</a>
                                        </li>
                                        <?php
                                        if (isset($_SESSION['user'])) {
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link text-white" href="{{route('don_hang')}}">Đơn hàng</a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- main content -->
    <main class="my-3">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-8">
                    <div class="slider">
                        <div id="carouselExampleCaptions" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="?act=san-pham"><img src="assets/img/BANNER-5.png" class="d-block w-100" alt="..."></a>
                                </div>
                                <div class="carousel-item">
                                    <a href="?act=san-pham"><img src="assets/img/BANNER-5.png" class="d-block w-100" alt="..."></a>

                                </div>
                                <div class="carousel-item">
                                    <a href="?act=san-pham"><img src="assets/img/BANNER-5.png" class="d-block w-100" alt="..."></a>

                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <img src="assets/img/bg1.jpg" alt="" style="width: 100%;">
                    </div>
                    <div>
                        <h6>Tin khuyến mãi</h6>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="assets/img/600_iphone_14_den_xtmobile.jpg" alt="" style="width: 100%;">
                            </div>
                            <div class="col-md-10 justify-items-center">
                                <h6>Điện thoại Iphone 14 giá tốt nhất hôm nay</h6>
                            </div>
                        </div>
                        <div class="row align-items-center mt-1">
                            <div class="col-md-2">
                                <img src="assets/img/600_iphone_14_128gb_chinh_hang.jpg" alt="" style="width: 100%;">
                            </div>
                            <div class="col-md-10 justify-items-center">
                                <h6>Điện thoại Samsung Zflip xu hướng giới trẻ</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            @yield('content')
        </div>



    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="../assets/js/admin.js"></script> -->
    <!-- footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Văn phòng giao dịch</h5>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                </div>
                <div class="col">
                    <h5>Thông tin chi tiết</h5>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                </div>
                <div class="col">
                    <h5>Tin tức mới nhất</h5>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                </div>
                <div class="col">
                    <h5>Giới thiệu cửa hàng</h5>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                    <p class="m-0">Trang chủ</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5>Thông tin cửa hàng</h5>
                    <p class="m-0">Địa chỉ: Fpt</p>
                    <p class="m-0">Địa chỉ: Fpt</p>
                    <p class="m-0">Địa chỉ: Fpt</p>
                    <p class="m-0">Địa chỉ: Fpt</p>
                </div>
                <div class="col-md-6">
                    @copyright 2023
                    <br>
                    <div>
                        <span class="box50 border mr-3 bg-light" style="color: #000000;"><i class="fa-brands fa-square-facebook"></i></span>
                        <span class="box50 border mr-3 bg-light" style="color: #000000;"><i class="fa-brands fa-google"></i></span>
                        <span class="box50 border mr-3 bg-light" style="color: #000000;"><i class="fa-brands fa-twitter"></i></span>
                        <span class="box50 border mr-3 bg-light" style="color: #000000;"><i class="fa-brands fa-youtube"></i></span>
                        <span class="box50 border mr-3 bg-light" style="color: #000000;"><i class="fa-brands fa-instagram"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>