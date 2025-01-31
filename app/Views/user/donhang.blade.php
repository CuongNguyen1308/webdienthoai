@extends('layouts.user')
@section('content')
<a href="?act=san-pham"> <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm</a>
<h5>Đơn hàng của bạn</h5>
<hr>
<?php
foreach ($ds_hd as $key => $value) {
?>
    <div class="row p-3 border border-2 rounded rounded-4 mb-2">
        <div class="col-md-12 justify-content-between d-flex align-items-end mb-3">
            <h5>Mã đơn hàng: #0<?= $value['id_hd'] ?></h5>
            <?php
            if ($value['id_tt'] == 1) {
                echo '<a class="btn btn-danger" href="?act=xoa-don&id_hd=' . $value['id_hd'] . '" onclick="return confirm(' . "'Bạn có chắc muốn hủy không ?'" . ')">Hủy đơn hàng</a>';
            } else 
                    if ($value['id_tt'] == 0) {
            } else if ($value['id_tt'] == 2) {
                echo '<h6 class="btn btn-secondary">Đang giao hàng</h6>';
            } else if ($value['id_tt'] == 3) {
                echo '<a href="?act=da-nhan&id_hd='. $value['id_hd'] .'" onclick="return confirm(' . "'Đã nhận được hàng'" . ')" class="btn btn-warning">Đã nhận được hàng</a>';
            } else if($value['id_tt'] == 5){
                echo '<h6 class="btn btn-success">Giao hàng thành công</h6>';
            }else {
                echo '<h6 class="btn btn-warning">Giao hàng không thành công</h6>';
            }
            ?>
        </div>
        <hr>
        <div class="thongtin d-flex gap-2">
            <p>Địa chỉ nhận hàng: <?= $value['ho_ten'] ?></p>
            <p><?= $value['dia_chi'] ?></p>
            <p>0<?= $value['so_dien_thoai'] ?></p>
        </div>
        <div class="">
            <p>Ngày đặt: <?= $value['ngay_dat'] ?></p>
            <p>Trạng thái đơn hàng: <?= $value['trang_thai'] ?></p>
        </div>
        <h6>Chi tiết đơn hàng: </h6>
        <hr>
            <div class="row mb-2 align-items-center">
                <div class="col-md-2">
                    <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" alt="" style="width: 100%;">
                </div>
                <div class="col-md-10">
                    <div class="name-product">
                        <h4><?= $value['ten_sp'] ?></h4>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="option d-flex gap-4">
                            <div class="">
                                <div class="mausac d-flex gap-1">
                                    <h6>Cấu hình: <?= $value['mau_sac'] . '-' . $value['dung_luong'] ?></h6>

                                </div>
                                <div class="soluong d-flex gap-1">
                                    <h6>Số lượng: <?= $value['so_luong'] ?></h6>

                                </div>

                            </div>
                        </div>
                        <div class="gia">
                            <h5 class="">Giá sản phẩm <?= number_format($value['gia_ban']) ?> đ</h5>
                        </div>
                    </div>
                </div>
            </div>
        
        <hr>
        <div class="justify-content-end d-flex">
            <h5 class="text-danger fw-bold">Tổng giá: <?= number_format($value['gia_ban']) ?> đ</h5>
        </div>
    </div>
<?php
}
?>
@endsection