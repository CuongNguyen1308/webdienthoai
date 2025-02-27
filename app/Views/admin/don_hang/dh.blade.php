@extends('layouts.admin')
@section('content')
<h3>Đơn hàng</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Địa chỉ</th>
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
                <th><?= $value['ho_ten'] ?></th>
                <th><?= $value['email'] ?></th>
                <th><?= $value['so_dien_thoai'] ?></th>
                <th><?= $value['dia_chi'] ?></th>
                <th><?= $value['ten_tt'] ?></th>
                <th><a href="{{route("admin/don_hang/".$value["id_hd"])}}" class="btn btn-info">Chi tiết đơn hàng</a>
                    
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