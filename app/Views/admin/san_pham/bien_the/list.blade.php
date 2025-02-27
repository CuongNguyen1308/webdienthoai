@extends('layouts.admin')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <h3>Danh sách biến thể sản phẩm - {{ $sanpham['ten_sp'] }}</h3>
    <a href="{{ route('admin/chi_tiet_san_pham/' . $sanpham['id_sp'] . '/add') }}" class="btn btn-primary">Thêm mới</a>
    <a href="{{ route('admin/chi_tiet_san_pham/' . $sanpham['id_sp'] . '/edit') }}"
        class="btn btn-warning">Sửa</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Màu sắc</th>
            <th>Dung lượng</th>
            <th>Số lượng</th>
            <th>Hình</th>

            <th>Action</th>
        </tr>
        @foreach ($list as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data['mau_sac'] }}</td>
                <td>{{ $data['dung_luong'] }}</td>
                <td>{{ $data['so_luong'] }}</td>
                <td><img src="{{ BASE_URL }}public/uploads/{{ $data['hinh_ctsp'] }}" alt="" height="50px"></td>

                <td>

                    <a href="{{ route('admin/chi_tiet_san_pham/' . $data['id_ctsp'] . '/delete') }}" class="btn btn-danger"
                        onclick="return confirm('bạn có muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
