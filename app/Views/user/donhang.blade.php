@extends('layouts.user')
@section('content')
    <div class="container mt-4">
        <a href="{{ route('san_pham') }}" class="btn btn-outline-primary mb-3">
            <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
        </a>
        <h4 class="mb-3">Đơn hàng của bạn</h4>
        @foreach ($ds_hd as $value)
            <div class="card mb-3 shadow border-0 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold">Mã đơn hàng: #0{{ $value['id_hd'] }}</h5>
                        @if ($value['id_tt'] == 1)
                            <a class="btn btn-danger" href="{{ route('don_hang/'.$value['id_hd'].'/huydon') }}" onclick="return confirm('Bạn có chắc muốn hủy không?')">Hủy đơn hàng</a>
                        @elseif ($value['id_tt'] == 2)
                            <h6 class="btn btn-secondary">Đang giao hàng</h6>
                        @elseif ($value['id_tt'] == 3)
                            <a href="{{ route('don_hang/'.$value['id_hd'].'/xacnhan') }}" onclick="return confirm('Đã nhận được hàng?')" class="btn btn-warning">Đã nhận được hàng</a>
                        @elseif ($value['id_tt'] == 5)
                            <h6 class="btn btn-success">Giao hàng thành công</h6>
                        @elseif ($value['id_tt'] == 0)

                        @else
                            <h6 class="btn btn-warning">Giao hàng không thành công</h6>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Địa chỉ nhận hàng:</strong> {{ $value['ho_ten'] }}</p>
                        <p class="mb-1"><strong>Địa chỉ:</strong> {{ $value['dia_chi'] }}</p>
                        <p class="mb-1"><strong>Số điện thoại:</strong> 0{{ $value['so_dien_thoai'] }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Ngày đặt:</strong> {{ $value['ngay_dat'] }}</p>
                        <p class="mb-1"><strong>Trạng thái đơn hàng:</strong> {{ $value['trang_thai'] }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('don_hang/'.$value['id_hd']) }}" class="link-primary text-decoration-none fw-bold">Xem chi tiết</a>
                        <h5 class="text-danger fw-bold">Tổng tiền: {{ number_format($value['tong_tien']) }} đ</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
