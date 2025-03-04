@extends('layouts.admin')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <h3>Danh sách sản phẩm</h3>
    <a href="{{ route('admin/san_pham/add_sp') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giảm giá</th>
            <th>Số lượng</th>
            <th>Hình</th>
            <th>Số lượt xem</th>
            <th>Danh mục</th>
            <th>Biến thể</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product['ten_sp'] }}</td>
                <td>{{ number_format($product['gia_goc']) }}</td>
                <td>{{ number_format($product['giam_gia']*$product['gia_goc']/100) }}</td>
                <td>{{ $product['sl'] }}</td>
                <td><img src="{{ BASE_URL }}public/uploads/{{ $product['hinh'] }}" alt="" height="50px"></td>
                <td>{{ $product['so_luot_xem'] }}</td>
                <td>{{ $product['ten_dm'] }}</td>
                <td><a href="{{ route('admin/chi_tiet_san_pham/' . $product['id_sp'] .'/san_pham') }}" class="btn btn-primary">Xem biến
                        thể</a></td>
                <td>
                    <a href="{{ route('admin/san_pham/' . $product['id_sp'] . '/edit_sp') }}"
                        class="btn btn-warning">Sửa</a>
                    <a href="{{ route('admin/san_pham/' . $product['id_sp'] . '/delete_sp') }}" class="btn btn-danger"
                        onclick="return confirm('bạn có muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        @endforeach
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
        if ($pagepre >= 1) {
        ?>
            <li class="page-item">
                <a class="page-link" href="{{ route('admin/san_pham/page/' . $pagepre . '/') }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
        }
        ?>

            <?php
        for ($i = $from; $i <= $to; $i++) {
        ?>
            <li class="page-item"><a class="page-link" href="{{ route('admin/san_pham/page/' . $i) }}"><?= $i ?></a></li>
            <?php } ?>
            <?php
        if ($pagenext <= $tongsotrang) {
        ?>
            <li class="page-item">
                <a class="page-link" href="{{ route('admin/san_pham/page/' . $pagenext . '/') }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
@endsection
