@extends('layouts.admin')
@section('content')
    <h3>Cập nhật danh mục</h3>
    <form action="{{ route('admin/danh_muc/'.$data['id_dm'].'/edit') }}" method="post" >
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="ten_dm" value="{{ $data['ten_dm'] }}" required/>
        <h6 class="text-danger">{{$thongbao}}</h6>
        <button type="submit" class="btn btn-primary my-2" name="btnsubmit">Thêm mới</button>
    </form>
@endsection
