@extends('layouts.user')
@section('content')
<div class="row">
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
                        <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/BANNER-5.png" class="d-block w-100" alt="..."></a>
                    </div>
                    <div class="carousel-item">
                        <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/BANNER-5.png" class="d-block w-100" alt="..."></a>

                    </div>
                    <div class="carousel-item">
                        <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/BANNER-5.png" class="d-block w-100" alt="..."></a>

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
            <img src="{{BASE_URL}}public/img/bg1.jpg" alt="" style="width: 100%;">
        </div>
        <div>
            <h6>Tin khuyến mãi</h6>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="{{BASE_URL}}public/img/600_iphone_14_den_xtmobile.jpg" alt="" style="width: 100%;">
                </div>
                <div class="col-md-10 justify-items-center">
                    <h6>Điện thoại Iphone 14 giá tốt nhất hôm nay</h6>
                </div>
            </div>
            <div class="row align-items-center mt-1">
                <div class="col-md-2">
                    <img src="{{BASE_URL}}public/img/600_iphone_14_128gb_chinh_hang.jpg" alt="" style="width: 100%;">
                </div>
                <div class="col-md-10 justify-items-center">
                    <h6>Điện thoại Samsung Zflip xu hướng giới trẻ</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-list ">
    <div class="product-title my-4">
        <h5 class="text-danger"><i class="fa-solid fa-fire"></i> KHUYẾN MÃI HOT</h5>
    </div>
    <div class="image-slider">
        <!-- 1 -->
        <?php
        foreach ($khuyenmai as $value) {
        ?>
            <div class="card position-relative" style="width: 18rem; height: 470px;">
                <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                    <div class="d-flex gap-2">
                        <p class="text-danger fw-bold"><?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
                        <span class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                    </div>
                    <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                    <a href='{{route("chi_tiet_san_pham/".$value['id_sp']."/")}}' class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:20px;">Mua ngay</a>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- end 1 -->


    </div>
</div>
<!--  -->
<div class="product-list-all ">
    <div class="product-title my-4">
        <h5 class="text-danger"><i class="fa-solid fa-fire"></i> SẢN PHẨM</h5>
    </div>
    <div class="row row-cols-4 g-5">
        <!-- 2 -->
        <?php
        foreach ($sanpham as $value) {
        ?>
            <div class="col">
                <div class="card position-relative" style="width: 18rem; height: 500px;">
                    <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                        <div class="d-flex gap-2">
                            <p class="text-danger fw-bold"><?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
                            <span class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                        </div>
                        <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                        <a href="{{route("chi_tiet_san_pham/".$value['id_sp']."/")}}" class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:20px;">Mua ngay</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- end -->

    </div>
</div>
<!-- Tin tức -->
<div class="news">
    <div class="title-news my-4">
        <h5 style="color: #005eff;"><i class="fa-solid fa-newspaper" style="color: #005eff;"></i>TIN TỨC MỚI
        </h5>
    </div>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-2">
                <img src="{{BASE_URL}}public/img/thanhlong.webp" class="img-fluid rounded-start" alt="..." style="height: 180px;">
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5 class="card-title">Biết ông lần không </h5>
                    <p class="card-text">Lần đầu tiên, Trái thanh long có trong mì tôm, Lần đầu tiên ,Mì thanh long mang theo lời nhắn, Tình yêu</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 15 mins ago</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-2 overflow-y-auto">
                <img src="{{BASE_URL}}public/img/redmi-k70-pro-ra-mat-8.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5 class="card-title">Redmi K70 pro ra mắt</h5>
                    <p class="card-text">Redmi K70 Pro có gì mới: Giá chỉ từ 11.3 triệu đã có Snapdragon 8 Gen 3, màn hình 4.000 nits, pin 5.000 mAh, sạc nhanh 120 W</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 hours ago</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-2">
                <img src="{{BASE_URL}}public/img/ip16.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5 class="card-title">Loạt nâng cấp dự kiến có trên iPhone 16 Pro</h5>
                    <p class="card-text">Hai bản iPhone 16 Pro và 16 Pro Max dự kiến có màn hình lớn và tiết kiệm pin hơn, hỗ trợ Wi-Fi 7, hệ thống tản nhiệt mới.</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 2 days ago</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service -->
<div class="service">
    <div class="title-service my-4">
        <h5 style="color: #ff00d9;"><i class="fa-solid fa-bookmark" style="color: #ff00d9;"></i> DỊCH VỤ
        </h5>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header bg-success fw-bold text-center text-light">Bảo hành điện thoại 1 đổi 1</div>
                <div class="card-body">
                    <img src="{{BASE_URL}}public/img/baohanh.jpg" alt="" height="200px" width="250px">
                    <h5 class="card-title text-center"></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header bg-danger fw-bold text-center text-light">Phụ kiện điện thoại giá rẻ</div>
                <div class="card-body">
                    <img src="{{BASE_URL}}public/img/phukien.jpg" alt="" height="200px">
                    <h5 class="card-title text-center"></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card  mb-3" style="max-width: 18rem;">
                <div class="card-header bg-primary fw-bold text-center text-light">Ưu đãi sản phẩm giảm giá sốc</div>
                <div class="card-body">
                    <img src="{{BASE_URL}}public/img/giamgia.png" alt="" height="200px" width="250px">
                    <h5 class="card-title text-center"></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 18rem;">
                <div class="card-header bg-warning fw-bold text-center text-light">Bảo hành vàng 1 tỉ ưu đãi</div>
                <div class="card-body">
                    <img src="{{BASE_URL}}public/img/baohanhvang.webp" class="text-center" alt="" height="200px" width="250px">
                    <h5 class="card-title text-center"></h5>
                </div>
            </div>
        </div>
    </div>
    <script src="{{BASE_URL}}public/js/app.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endsection