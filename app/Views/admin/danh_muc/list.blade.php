@extends('layouts.admin')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <h3>Danh mục sản phẩm</h3>
    <a href="{{ route('admin/danh_muc/add') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table">
        <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
        @foreach ($listdm as $key => $value)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $value['ten_dm'] }}</th>
                <td>
                    <a href="{{ route('admin/danh_muc/' . $value['id_dm'] . '/edit') }}" class="btn btn-warning">Sửa</a>
                    <a href="{{ route('admin/danh_muc/' . $value['id_dm'] . '/delete') }}" class="btn btn-danger"
                        onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
