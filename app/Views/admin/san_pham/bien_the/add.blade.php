@extends('layouts.admin')
@section('content')
<h3>Thêm biến thể sản phẩm</h3>
<form action="{{ route('admin/chi_tiet_san_pham/'.$sanpham['id_sp'].'/add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Màu sắc</th>
                <th>Dung lượng</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="variant-container">
            <tr class="variant-item">
                <td><input type="text" class="form-control" name="mau_sac[]" required></td>
                <td><input type="text" class="form-control" name="dung_luong[]" required></td>
                <td><input type="number" min="0" value="0" class="form-control" name="so_luong[]" required></td>
                <td><input type="file" class="form-control" name="hinh[]"></td>
                <td><button type="button" class="btn btn-danger remove-variant">Xóa</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-success mt-2" id="add-variant">Thêm biến thể</button>
    <button type="submit" class="btn btn-primary mt-2" name="btnsubmit">Thêm mới</button>
</form>

<script>
    document.getElementById("add-variant").addEventListener("click", function () {
        let container = document.getElementById("variant-container");
        let newRow = document.createElement("tr");
        newRow.classList.add("variant-item");
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="mau_sac[]" required></td>
            <td><input type="text" class="form-control" name="dung_luong[]" required></td>
            <td><input type="number" min="0" value="0" class="form-control" name="so_luong[]" required></td>
            <td><input type="file" class="form-control" name="hinh[]"></td>
            <td><button type="button" class="btn btn-danger remove-variant">Xóa</button></td>
        `;
        container.appendChild(newRow);

        newRow.querySelector(".remove-variant").addEventListener("click", function () {
            newRow.remove();
        });
    });

    document.querySelectorAll(".remove-variant").forEach(button => {
        button.addEventListener("click", function () {
            this.closest("tr").remove();
        });
    });
</script>
@endsection
