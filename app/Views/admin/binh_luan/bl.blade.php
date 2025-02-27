@extends('layouts.admin')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <h3>Danh sách bình luận</h3>
    <table class="table">
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượt bình luận</th>
            <th>Xem bình luận</th>
        </tr>
        @foreach ($list as $key => $value)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $value['ten_sp'] }}</th>
                <th>{{ $value['so_luot_bl'] }}</th>
                <th><a href="{{ route('admin/binh_luan/' . $value['id_sp'] ) }}" class="btn btn-warning">Xem</a></th>
            </tr>
        @endforeach
    </table>
@endsection
