@extends('layouts.admin')
@section('content')

<h3>Danh sách sản phẩm</h3>
<a href="{{ route('admin/san_pham/add_sp') }}" class="btn btn-primary">Add product</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá gốc</th>
        <th>Giảm giá</th>
        <th>Mô tả</th>
        <th>Hình</th>
        <th>Số lượt xem</th>
        <th>Danh mục</th>
        <th>Action</th>
    </tr>
    @foreach ($products as $product)
    
    <tr>
        <td>{{ $product['id_sp'] }}</td>
        <td>{{ $product['ten_sp'] }}</td>
        <td>{{ $product['gia_goc'] }}</td>
        <td>{{ $product['giam_gia'] }}</td>
        <td>{{ $product['mo_ta'] }}</td>
        <td><img src="{{BASE_URL}}public/uploads/{{$product['hinh']}}" alt="" height="50px"></td>
        <td>{{ $product['so_luot_xem'] }}</td>
        <td>{{ $product['ten_dm'] }}</td>
        <td>
            <a href="{{ route('admin/san_pham/' . $product['id_sp'] . '/edit_sp') }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin/san_pham/' . $product['id_sp'] . '/delete_sp') }}" class="btn btn-danger" onclick="return confirm('bạn có muốn xóa không?')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
