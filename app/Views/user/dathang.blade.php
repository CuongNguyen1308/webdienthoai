@extends('layouts.user')
@section('content')
<form class="row my-5" method="post">
  <div class="col-md-6 p-3">
    <div class="row g-3 needs-validation">
      <div class="col-md-12 ">
        <label for="validationCustom01" class="form-label">Full name</label>
        <input name="ho_ten" type="text" class="form-control" id="validationCustom01" value="<?= $_SESSION['user']['ho_ten'] ?>" required>
      </div>
      <div class="col-md-12">
        <label for="validationCustom07" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="validationCustom07" value="<?= $_SESSION['user']['email'] ?>" required>
      </div>
      <div class="col-md-12">
        <label for="validationCustom07" class="form-label">Số điện thoại</label>
        <input name="so_dien_thoai" type="number" class="form-control" id="validationCustom07" value="<?= $_SESSION['user']['so_dien_thoai'] ?>" required>
      </div>
      <div class="col-md-12">
        <label for="validationCustom06" class="form-label">Địa chỉ</label>
        <input name="dia_chi" type="text" class="form-control" id="validationCustom06" value="<?= $_SESSION['user']['dia_chi'] ?>" required>
      </div>
    
    </div>
  </div>
  <div class="col-md-6 bg-light p-3">
    <h5>Sản phẩm của bạn</h5>
    <hr>
    <div class="row">
      <div class="col-md-9">
        <h6>Sản phẩm</h6>
      </div>
      <div class="col-md-3">
        <h6>Giá</h6>
      </div>
    </div>
    <!--  -->
    <?php
      $gia_ban = ceil(($_SESSION['san_pham']['gia_goc'] - $_SESSION['san_pham']['gia_goc'] * ($_SESSION['san_pham']['giam_gia'] / 100)))*$_SESSION['so_luong'];
    ?>
      <input type="text" name="id_sp"  value="{{$_SESSION['san_pham']['id_sp']}}" hidden>
      <input type="text" name="mau_sac"  value="{{$_SESSION['ctsp']['mau_sac']}}" hidden>
      <input type="text" name="dung_luong"  value="{{$_SESSION['ctsp']['dung_luong']}}" hidden>
      <input type="text" name="so_luong"  value="{{$_SESSION['so_luong']}}" hidden>
      <input type="text" name="gia_ban"  value="{{$gia_ban}}" hidden>
      <div class="row">
        <div class="col-md-9"><?= $_SESSION['so_luong'] . ' x ' . $_SESSION['san_pham']['ten_sp'] .' ('.$_SESSION['ctsp']['mau_sac'] . '-' . $_SESSION['ctsp']['dung_luong'].')'?></div>
        <div class="col-md-3"><?= number_format(ceil($_SESSION['san_pham']['gia_goc'] - $_SESSION['san_pham']['gia_goc'] * ($_SESSION['san_pham']['giam_gia'] / 100))*$_SESSION['so_luong']) ?></div>
      </div>
    <!--  -->
    <hr>
    <div class="row">
      <div class="col-md-9">Tạm tính</div>
      <div class="col-md-3"><?= number_format(ceil($_SESSION['san_pham']['gia_goc'] - $_SESSION['san_pham']['gia_goc'] * ($_SESSION['san_pham']['giam_gia'] / 100))*$_SESSION['so_luong']) ?></div>
    </div>
    <div class="row">
      <div class="col-md-9">Phí vận chuyển</div>
      <div class="col-md-3"><?=0?></div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-9">Thành tiền</div>
      <div class="col-md-3"><?=number_format(ceil($_SESSION['san_pham']['gia_goc'] - $_SESSION['san_pham']['gia_goc'] * ($_SESSION['san_pham']['giam_gia'] / 100))*$_SESSION['so_luong'])?></div>
    </div>
    <div class="d-flex justify-content-center my-3 ">
      <button name="dat_hang" class="btn btn-primary py-3 px-5" type="submit" onclick="return alert('Chúc mừng bạn đã đặt hàng thành công')">Đặt hàng</button>

    </div>
  </div>
</form>
@endsection