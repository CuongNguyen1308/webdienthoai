@extends('layouts.admin')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
<div class="mb-3">
        <input type="text" class="form-control" name="id_sp" value="<?=$sanpham['id_sp']?>" hidden>
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="ten_sp" value="<?=$sanpham['ten_sp']?>" required />
        <label for="name" class="form-label">Giá</label>
        <input type="number" min="0" class="form-control" name="gia_goc" value="<?=$sanpham['gia_goc']?>"/>
        <label for="name" class="form-label">Giảm giá</label>
        <input type="number" min="0" max="100" class="form-control" name="giam_gia" value="<?=$sanpham['giam_gia']?>"/>
        <label for="name" class="form-label">Mô tả</label>
        <input type="text" class="form-control" name="mo_ta" value="<?=$sanpham['mo_ta']?>"/>
        <img src="{{BASE_URL}}public/uploads/<?=$sanpham['hinh']?>" alt="" style=" height: 100px;" > <br>
        <label for="name" class="form-label">Hình ảnh</label>
        <input type="file" class="form-control" name="hinh" />
        <label for="name" class="form-label">Tên danh mục</label> <br>
        <select name="id_dm" id="">
            <?php
            foreach ($ds_dm as $value) {
            ?>
                <option value="<?= $value['id_dm'] ?>" <?php 
                    if ($value['id_dm'] == $sanpham['id_dm']) {
                        echo "selected";
                    }
                ?>><?= $value['ten_dm'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name="btnsubmit">Cập nhật</button>
</form>
@endsection
