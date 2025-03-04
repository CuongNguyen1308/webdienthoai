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
            <th>Tên người dùng</th>
            <th>Nội dung</th>
            <th>Hoạt động</th>
        </tr>
        @foreach ($list as $key => $value)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $value['ho_ten'] }}</th>
                <th>{{ $value['noi_dung'] }}</th>
                <th><a href="{{ route('admin/binh_luan/' . $value['id_bl'] . '/delete') }}" class="btn btn-danger"
                        onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a></th>
            </tr>
        @endforeach
    </table>
@endsection
