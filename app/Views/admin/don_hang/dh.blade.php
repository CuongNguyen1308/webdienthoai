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
                    <?php
                        if($value['trang_thai']!=0 && $value['trang_thai']!=3 && $value['trang_thai'] != 5){
                            ?>
                            <a href="?act=editdh&id_hd=<?= $value['id_hd'] ?>" class="btn btn-warning">Trạng thái đơn</a>
                            <?php
                        }
                    ?>
                </th>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
@endsection