@extends('layouts.user')
@section('content')
    <div class="container mt-4">
        <a href="{{ route('don_hang') }}" class="btn btn-outline-primary mb-3">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
        <h4 class="mb-3">Chi tiết đơn hàng</h4>
        @foreach ($ds_cthd as $value)
            <div class="card mb-3 shadow border-0 rounded-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2 p-3">
                        <img src="{{ BASE_URL }}public/uploads/{{ $value['hinh'] }}" class="img-fluid rounded" alt="{{ $value['ten_sp'] }}">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <a class="card-title fw-bold" href="{{ route('chi_tiet_san_pham/'.$value['id_sp']) }}">{{ $value['ten_sp'] }}</a>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <p class="mb-1"><strong>Cấu hình:</strong> {{ $value['mau_sac'] }} - {{ $value['dung_luong'] }}</p>
                                    <p class="mb-1"><strong>Số lượng:</strong> {{ $value['so_luong'] }}</p>
                                </div>
                                <div class="text-end">
                                    <h5 class="text-danger fw-bold">{{ number_format($value['gia_ban']*$value['so_luong']) }} đ</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
