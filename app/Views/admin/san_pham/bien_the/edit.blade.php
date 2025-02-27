@extends('layouts.admin')
@section('content')
<h3>Chỉnh sửa biến thể sản phẩm - {{ $sanpham['ten_sp'] }}</h3>

<form action="{{ route('admin/chi_tiet_san_pham/'.$sanpham['id_sp'].'/edit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Màu sắc</th>
                <th>Dung lượng</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
            </tr>
        </thead>
        <tbody id="variant-container">
            @foreach ($list as $variant)
                <tr class="variant-item">
                    <input type="hidden" name="id_ctsp[]" value="{{ $variant['id_ctsp'] }}">
                    <td><input type="text" class="form-control" name="mau_sac[]" value="{{ $variant['mau_sac'] }}" required></td>
                    <td><input type="text" class="form-control" name="dung_luong[]" value="{{ $variant['dung_luong'] }}" required></td>
                    <td><input type="number" min="0" value="{{ $variant['so_luong'] }}" class="form-control" name="so_luong[]" required></td>
                    <td>
                        <input type="file" class="form-control" name="hinh[]">
                        <img src="{{ BASE_URL }}public/uploads/{{ $variant['hinh_ctsp'] }}" alt="" height="50px">
                        <input type="hidden" name="old_hinh[]" value="{{ $variant['hinh_ctsp'] }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary mt-2">Lưu thay đổi</button>
</form>


@endsection
