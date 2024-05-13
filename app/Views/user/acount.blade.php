@extends('layouts.user')
@section('content')
<h4>Hồ sơ của tôi</h4>
<p>Quản lý hồ sơ</p>
<hr>
<div class="row">
    <div class="avatar d-flex justify-content-center">
        <img src="{{BASE_URL}}public/uploads/<?= $_SESSION['user']['hinh'] ?>" alt="" style="border-radius: 50%; height: 100px;">
    </div>
    <div class="col-md-12 ">
        <label for="validationCustom01" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $_SESSION['user']['ho_ten'] ?>" disabled>
    </div>
    <div class="col-md-12 ">
        <label for="validationCustom01" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $_SESSION['user']['dia_chi'] ?>" disabled>
    </div>
    <div class="col-md-12 ">
        <label for="validationCustom01" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $_SESSION['user']['so_dien_thoai'] ?>" disabled>
    </div>
    <div class="col-md-12 ">
        <label for="validationCustom01" class="form-label">Email</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $_SESSION['user']['email'] ?>" disabled>
    </div>
    <hr class="my-3">
    <h5><a href="?act=cap-nhat-tk" class="btn btn-info">Cập nhật tài khoản</a></h5>
    <!--  -->
    
    <!--  -->
</div>
<hr class="my-3">
<div class="logout d-flex justify-content-between">
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['phan_quyen'] == 0) {
            echo '<a class="btn btn-warning" href='.route('admin').'>Chuyển sang trang quản trị</a>';
        }
    }
    ?>
    <form action="" method="post">
        <button class="btn btn-primary" name="logout">Đăng xuất tài khoản</button>
    </form>
</div>
@endsection