@extends('layouts.user')
@section('content')
<h4 class="fw-bold">Hồ sơ của tôi</h4>
<p class="text-muted">Quản lý hồ sơ</p>
<hr>
<div class="row">
    <div class="col-12 d-flex justify-content-center mb-3">
        <img src="{{BASE_URL}}public/uploads/{{ $_SESSION['user']['hinh'] }}" alt="Avatar" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Họ và Tên</label>
        <input type="text" class="form-control" value="<?= $_SESSION['user']['ho_ten'] ?>" disabled>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Địa chỉ</label>
        <input type="text" class="form-control" value="<?= $_SESSION['user']['dia_chi'] ?>" disabled>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Số điện thoại</label>
        <input type="text" class="form-control" value="<?= $_SESSION['user']['so_dien_thoai'] ?>" disabled>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="text" class="form-control" value="<?= $_SESSION['user']['email'] ?>" disabled>
    </div>
</div>
<hr class="my-4">
<div class="d-flex justify-content-between align-items-center">
    <a href="?act=cap-nhat-tk" class="btn btn-info px-4">Cập nhật tài khoản</a>
    <div>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['phan_quyen'] == 0) { ?>
            <a href="{{ route('admin') }}" class="btn btn-warning px-4">Chuyển sang trang quản trị</a>
        <?php } ?>
        <form action="" method="post" class="d-inline">
            <button class="btn btn-danger px-4" name="logout">Đăng xuất</button>
        </form>
    </div>
</div>
@endsection
