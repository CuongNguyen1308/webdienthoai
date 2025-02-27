@extends('layouts.admin')
@section('content')
    <h3>Thêm danh mục</h3>
    <form action="{{ route('admin/danh_muc/add') }}" method="post" >
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="ten_dm" />
        <h6 class="text-danger">{{$thongbao}}</h6>
        <button type="submit" class="btn btn-primary my-2" name="btnsubmit">Thêm mới</button>
    </form>
@endsection
