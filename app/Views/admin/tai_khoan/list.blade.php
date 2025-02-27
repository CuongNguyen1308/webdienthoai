@extends('layouts.admin')
@section('content')
    <h3>Danh sách tài khoản</h3>
    <table class="table">
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Phân quyền</th>
            <th>Hành động</th>
        </tr>
        @foreach ($list as $key => $value)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $value['ho_ten'] }}</th>
                <th>{{ $value['email'] }}</th>
                <th>{{ $value['so_dien_thoai'] }}</th>
                <th>{{ $value['phan_quyen'] == 0 ? 'admin' : 'user' }}</th>
                <td>
                    <a href="{{ route('admin/danh_muc/' . $product['id_dm'] . '/edit_sp') }}" class="btn btn-primary">Sửa</a>
                    @if ($value['phan_quyen'] != 0)
                        <a href="{{ route('admin/danh_muc/' . $product['id_dm'] . '/delete_sp') }}" class="btn btn-danger"
                            onclick="return confirm('bạn có muốn xóa không?')">Xóa</a>
                    @endif

                </td>
            </tr>
        @endforeach
    </table>
@endsection
