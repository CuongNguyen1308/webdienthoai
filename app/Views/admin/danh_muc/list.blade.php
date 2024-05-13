@extends('layouts.admin')
@section('content')
<h3>Danh mục sản phẩm</h3>
<table class="table">
    <tr>
        <th>STT</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
    @foreach ($listdm as $key=>$value)
    <tr>
        <th>{{$key+1}}</th>
        <th>{{$value['ten_dm']}}</th>
        <td>
        <a href="{{ route('admin/danh_muc/' . $product['id_dm'] . '/edit_sp') }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin/danh_muc/' . $product['id_dm'] . '/delete_sp') }}" class="btn btn-danger" onclick="return confirm('bạn có muốn xóa không?')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
