@extends('layouts.admin')
@section('content')
    <h3>Cập nhật đơn hàng</h3>
    <form action="{{ route('admin/don_hang/'.$donhang['id_hd'].'/edit') }}" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Trạng thái</label> <br>

            @if ($donhang['trang_thai'] == 1)
                <select name="trang_thai" id="">
                    <option value="1" selected>Đang chuẩn bị hàng</option>
                    <option value="2">Đang giao hàng</option>
                </select>
            @endif

            @if ($donhang['trang_thai'] == 2)
                <select name="trang_thai" id="">
                    <option value="2" selected>Đang giao hàng</option>
                    <option value="3">Hàng đã vận chuyển đến</option>
                </select>
            @endif

            @if ($donhang['trang_thai'] == 3)
                <select name="trang_thai" id="">
                    <option value="3" selected>Hàng đã vận chuyển đến</option>
                    <option value="4" >Giao hàng thất bại</option>
                    <option value="5" >Đã nhận được hàng</option>
                </select>
            @endif
            
        </div>
        <h6 class="text-danger">{{ $thongbao }}</h6>
        <button type="submit" class="btn btn-primary" name="btnsubmit">Cập nhật</button>
    </form>
@endsection
