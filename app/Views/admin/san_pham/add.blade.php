@extends('layouts.admin')
@section('content')
<h3>Thêm sản phẩm</h3>
<form action="{{ route("admin/san_pham/add_sp") }}" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="ten_sp" />
        <label for="name" class="form-label">Giá</label>
        <input type="number" min="0" value="0" class="form-control" name="gia_goc" required />
        <label for="name" class="form-label">Giảm giá</label>
        <input type="number" min="0" max="100" value="0" class="form-control" name="giam_gia" required />
        <label for="name" class="form-label">Mô tả</label>
        <input type="text" class="form-control" name="mo_ta" />
        <label for="name" class="form-label">Hình ảnh</label>
        <input type="file" class="form-control" name="hinh" />
        <label for="name" class="form-label">Tên danh mục</label> <br>
        <select name="id_dm" id="">
            <?php
            foreach ($ds_dm as $value) {
            ?>
                <option value="<?= $value['id_dm'] ?>"><?= $value['ten_dm'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <h6 class="text-danger">{{$thongbao}}</h6>
    <button type="submit" class="btn btn-primary" name="btnsubmit">Thêm mới</button>
</form>

@endsection