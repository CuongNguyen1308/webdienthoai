@extends('layouts.user')
@section('content')
    <form class="row my-5" method="post">
        <div class="col-md-6 p-3">
            <div class="row g-3 needs-validation">
                <div class="col-md-12 ">
                    <label for="validationCustom01" class="form-label">Full name</label>
                    <input name="ho_ten" type="text" class="form-control" id="validationCustom01"
                        value="<?= $_SESSION['user']['ho_ten'] ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="validationCustom07" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="validationCustom07"
                        value="<?= $_SESSION['user']['email'] ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="validationCustom07" class="form-label">Số điện thoại</label>
                    <input name="so_dien_thoai" type="number" class="form-control" id="validationCustom07"
                        value="<?= $_SESSION['user']['so_dien_thoai'] ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="validationCustom06" class="form-label">Địa chỉ</label>
                    <input name="dia_chi" type="text" class="form-control" id="validationCustom06"
                        value="<?= $_SESSION['user']['dia_chi'] ?>" required>
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
            @if (isset($_SESSION['cart']))
                @foreach ($_SESSION['san_pham'] as $san_pham)
                    @php
                        $gia_ban =
                            ceil($san_pham['gia_goc'] - $san_pham['gia_goc'] * ($san_pham['giam_gia'] / 100)) *
                            $san_pham['so_luong'];
                    @endphp
                    <input type="text" name="id_gh[]" value="{{ $san_pham['id_gh'] }}" hidden>
                    

                    <div class="row">
                        <div class="col-md-9">
                            {{ $san_pham['so_luong'] . ' x ' . $san_pham['ten_sp'] . ' (' . $san_pham['mau_sac'] . '-' . $san_pham['dung_luong'] . ')' }}
                        </div>
                        <div class="col-md-3">
                            {{ number_format($gia_ban) }}
                        </div>
                    </div>
                @endforeach

                <hr>
                <div class="row">
                    <div class="col-md-9">Tạm tính</div>
                    <div class="col-md-3">
                        {{ number_format(array_sum(array_map(fn($sp) => ceil($sp['gia_goc'] - $sp['gia_goc'] * ($sp['giam_gia'] / 100)) * $sp['so_luong'], $_SESSION['san_pham']))) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">Phí vận chuyển</div>
                    <div class="col-md-3">0</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">Thành tiền</div>
                    <div class="col-md-3">
                        {{ number_format(array_sum(array_map(fn($sp) => ceil($sp['gia_goc'] - $sp['gia_goc'] * ($sp['giam_gia'] / 100)) * $sp['so_luong'], $_SESSION['san_pham']))) }}
                    </div>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <button name="dat_hang_gh" class="btn btn-primary py-3 px-5" type="submit"
                        onclick="return alert('Chúc mừng bạn đã đặt hàng thành công')">
                        Đặt hàng
                    </button>
                </div>
                @endif
        </div>

        </div>
    </form>
@endsection
