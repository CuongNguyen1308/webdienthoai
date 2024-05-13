@extends('layouts.user')
@section('content')
<form action="" method="post">
    <div class="name-product my-5">
        <h4><?= $sanpham['ten_sp'] ?></h4>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="slider border p-3 rounded rounded-2">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <?php
                        foreach ($ctsp as $key => $value) {
                        ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key + 1 ?>" aria-label="Slide <?= $key + 2 ?>"></button>
                        <?php } ?>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{BASE_URL}}public/uploads/<?= $sanpham['hinh'] ?>" class="d-block w-100" alt="...">

                        </div>
                        <?php
                        foreach ($ctsp as $key => $value) {
                        ?>
                            <div class="carousel-item">
                                <img src="{{BASE_URL}}public/uploads/<?= $value['hinh_ctsp'] ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php } ?>
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
        <div class="col-md-8">
            <div class="d-flex gap-2">
                <h4 class="text-danger fw-bold"><?= number_format(ceil($sanpham['gia_goc'] - $sanpham['gia_goc'] * ($sanpham['giam_gia'] / 100))) ?>VND</h4>
                <h5 class="text-decoration-line-through"><?= number_format($sanpham['gia_goc']) ?></h5>
            </div>
            <h5 class="my-3">Lựa chọn cấu hình</h5>
            <h6 class="text-danger">{{$thong_bao}}</h6>
            <div class="dung-luong d-flex gap-2">
                <div class="d-flex gap-2">
                    <?php
                    foreach ($ctsp as $key => $value) {
                    ?>
                        <div class="border border-1 rounded rounded-2 p-2">
                            <input type="radio" name="id_ctsp" value="<?= $value['id_ctsp'] ?>" <?php if (isset($_GET['id_ctsp'])) {
                                                                                                    if ($id_ctsp == $value['id_ctsp']) {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } ?>>

                            <a href="{{route("chi_tiet_san_pham/".$sanpham['id_sp']."/".$value['id_ctsp']."/")}}"><?= $value['mau_sac'] . '-' . $value['dung_luong'] ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <h5 class="my-3">Số lượng</h5>
            <div class="so_luong">
                <?php

                if (isset($_GET['id_ctsp'])) {
                    $one_ctsp = getone_ctsp($_GET['id_ctsp']);
                    echo "<p class='text-danger'>Kho còn " . $one_ctsp['so_luong'] . "</p>";
                }
                ?>
                <div class="quantity">
                    <input type="number" value="1" min="1" max="<?php
                                                                if (isset($_GET['id_ctsp'])) {
                                                                    echo $one_ctsp['so_luong'];
                                                                } ?>" name="so_luong" class="number">
                </div>
            </div>
            <h5 class="my-3">Mô tả ngắn</h5>
            <div class="mota">
                <span><?= $sanpham['mo_ta'] ?></span>
            </div>
            <div class="form-input my-5 ">
                <div class="row">
                    <div class="col">

                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <button name="mua_ngay" class="btn btn-danger" style="width: 100%;padding: 20px">Mua ngay</button>
                        <?php
                        } else {
                        ?>
                            <a href="{{route('login')}}" class="btn btn-danger" style="width: 100%;padding: 20px">Mua ngay</a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col">
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <button name="them_vao_gio" class="btn btn-primary" style="width: 100%;padding: 20px">Thêm vào giỏ hàng</button>
                        <?php
                        } else {
                        ?>
                            <a href="{{route('login')}}" class="btn btn-primary" style="width: 100%;padding: 20px">Thêm vào giỏ hàng</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</form>
<!-- All sản phẩm -->
<div class="row mt-3">
    <div class="col-md-7" style="height: 500px; overflow: scroll;">
        <h5 class="my-2" style="text-align: center;">ĐẶC ĐIỂM NỔI BẬT</h5>
        <h6>iPhone 15 Pro 256GB - Một trong những smartphone được ưa chuộng nhất hiện nay</h6>
        <p>iPhone 15 Pro 256GB là một trong những thiết bị cao cấp nhất nhà Apple trong năm 2023. Điện thoại
            gây chú ý với nhiều tính năng mở rộng mà người dùng sẽ không thể tìm thấy trên mẫu iPhone 15
            tiêu chuẩn. Chúng bao gồm con chip A17 Pro mạnh mẽ, khung Titan bền bỉ, nút Action linh hoạt và
            USB-C tiện ích. Cùng XTmobile khám phá chi tiết về những ưu điểm vượt trội này nhé!</p>
        <h6>Ưu đãi khi mua iPhone 15 Pro 256GB tại XTmobile</h6>
        <p>Trước khi đi vào phần đánh giá chi tiết, bạn đọc có thể tìm hiểu thêm một số ưu đãi khi mua
            iPhone 15 Pro 256GB tại XTmobile. </p>
        <ul>
            <li>Giảm thêm 1.2% sản phẩm nếu đăng ký thẻ thành viên XTmember</li>
            <li>Sản phẩm demo</li>
            <li>Hiiiiiiiiiiiiiiii</li>
        </ul>
        <img src="assets/img/bg2.jpg" alt="" style="width: 100%;">
        <span>Ngoài ra, để quý khách hàng yên tâm mua sắm, XTmobile còn hỗ trợ các chính sách bảo hành 12
            tháng, 1 đổi 1 trong vòng 30 ngày khi máy gặp lỗi từ nhà sản xuất. Bên cạnh đó là chương trình
            trải nghiệm sản phẩm trong 7 ngày đầu tiên khi khách hàng tham gia chính sách Bảo Hành Mở Rộng
            của hệ thống. </span>
        <h6>Bảng thông số kỹ thuật chi tiết của iPhone 15 Pro</h6>
        <p>Không chỉ bổ sung các tính năng mới, iPhone 15 Pro 256GB còn sở hữu nhiều thông số lý tưởng. Cùng
            XTmobile khám phá bảng thông số kỹ thuật chi tiết dưới đây để xem liệu nó có những nâng cấp và
            điểm mới nào trong năm nay. </p>
    </div>
    <div class="col-md-5" style="height: 500px;">
        <h5 class="my-2" style="text-align: center;">THÔNG SỐ KỸ THUẬT</h5>
        <ul class="parametdesc">
            <li class='row0'><span>Màn hình:</span>
                <strong>6.1 inches, LTPO Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision, 1000
                    nits</strong>
            </li>
            <li class='row1'><span>Camera trước:</span>
                <strong>12 MP</strong>
            </li>
            <li class='row0'><span>Camera sau:</span>
                <strong>Chính 48 MP & Phụ 12 MP, 12 MP</strong>
            </li>
            <li class='row1'><span>Chipset:</span>
                <strong>Apple A17 Pro</strong>
            </li>
            <li class='row0'><span>RAM:</span>
                <strong>8 GB</strong>
            </li>
            <li class='row1'><span>Bộ nhớ trong:</span>
                <strong>256GB</strong>
            </li>
            <li class='row0'><span>Thẻ Sim:</span>
                <strong>1 Nano SIM & 1 eSIM</strong>
            </li>
            <li class='row1'><span>Pin:</span>
                <strong>3274 mAh, 20W</strong>
            </li>
            <li class='row0'><span>Hệ điều hành:</span>
                <strong>iOS 17</strong>
            </li>
        </ul>
    </div>
</div>
<!--  -->
<div class="form-bl border p-3">
    <h6 class="text-info mb-3">Đánh giá sản phẩm</h6>
    <div class="binh_luan">
        <!--  -->
        <?php
        if (empty($ds_bl)) {
            echo 'Chưa có bình luận nào';
        }
        foreach ($ds_bl as $key => $value) {
        ?>
            <div class="row my-3">
                <div class="col-md-1 rounded rounded-6">
                    <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" alt="" style="width: 100%; border-radius: 50%;">
                </div>
                <div class="col-md-11">
                    <h6><?= $value['ho_ten'] ?></h6>
                    <p><?= $value['noi_dung'] ?></p>
                    <span class="" style="font-size: 12px; color: blue;">Ngày đăng <?= $value['ngay_dang'] ?></span>
                </div>
            </div>
        <?php
        }
        ?>
        <hr>
        <!--  -->
        <?php
        if (isset($_SESSION['login'])) {
        ?>
            <form action="" method="post">
                <div class="form-floating">
                    <input class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="noi_dung"></input>
                    <label for="floatingTextarea">Comments</label>
                    <button name="btn_guibl" style="display:none">Gửi</button>
                </div>
            </form>
        <?php
        } else {
            echo 'Vui lòng đăng nhập để bình luận';
        }
        ?>
    </div>
</div>

<h5 class="text-danger my-4"><i class="fa-solid fa-fire"></i> SẢN PHẨM LIÊN QUAN</h5>
<div class="row row-cols-4 g-5">
    <!--  -->
    <?php
    foreach ($sanphamlq as $key => $value) {
    ?>
        <div class="col">
            <div class="card position-relative" style="width: 18rem; height: 490px;">
                <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                    <div class="d-flex gap-2">
                        <p class="text-danger fw-bold"><?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
                        <span class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                    </div>
                    <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                    <a href="{{route("chi_tiet_san_pham/".$value['id_sp'])}}" class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:20px;">Mua ngay</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!--  -->
</div>

@endsection