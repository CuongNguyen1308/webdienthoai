@extends('layouts.admin')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <h3>Đơn hàng</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Thông tin</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Ngày đặt hàng</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
        foreach ($hoadon as $key => $value) {
        ?>
            <tr>
                <th><?= $key + 1 ?></th>
                <th>
                    <ul>
                        <li><?= $value['ho_ten'] ?></li>
                        <li><?= $value['email'] ?></li>
                        <li><?= $value['so_dien_thoai'] ?></li>
                    </ul>
                </th>
                <th><?= $value['dia_chi'] ?></th>
                <th><?= $value['ngay_dat'] ?></th>
                <th><?= $value['ten_tt'] ?></th>
                <th><a href="{{ route('admin/don_hang/' . $value['id_hd']) }}" class="btn btn-info">Chi tiết đơn</a>
                    @if ($value['trang_thai'] != 0 && $value['trang_thai'] != 4 && $value['trang_thai'] != 5)
                        <a href="{{ route('admin/don_hang/' . $value['id_hd'] . '/edit') }}" class="btn btn-warning">Trạng thái
                            đơn</a>
                    @endif
                </th>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
    if ($pagepre >= 1) {
    ?>
            <li class="page-item">
                <a class="page-link" href="{{ route('admin/don_hang/page/' . $pagepre . '/') }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
    }
    ?>

            <?php
    for ($i = $from; $i <= $to; $i++) {
    ?>
            <li class="page-item"><a class="page-link" href="{{ route('admin/don_hang/page/' . $i) }}"><?= $i ?></a></li>
            <?php } ?>
            <?php
    if ($pagenext <= $tongsotrang) {
    ?>
            <li class="page-item">
                <a class="page-link" href="{{ route('admin/don_hang/page/' . $pagenext . '/') }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
@endsection
