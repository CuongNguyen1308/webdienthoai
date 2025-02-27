<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Danhmuc;

class CategoryController extends BaseController
{
    protected $danhmucModel;

    public function __construct()
    {
        $this->danhmucModel = new Danhmuc();
    }

    public function danh_muc()
    {
        $listdm = $this->danhmucModel->danhsach_danhmuc();
        $title = "Danh sách danh mục";
        $this->render('admin.danh_muc.list', compact('listdm', 'title'));
    }

    public function add()
    {
        $title = "Thêm danh mục";
        $this->render('admin.danh_muc.add', compact('title'));
    }
    public function create()
    {
        $title = "Thêm danh mục";
        $ten_dm = $_POST['ten_dm'];

        if (empty($ten_dm)) {
            $thongbao = "Vui lòng nhập đủ thông tin";
            $this->render('admin.danh_muc.add', compact('title', 'thongbao'));
        } else {
            $this->danhmucModel->add_danhmuc($ten_dm);
            $_SESSION['success_message'] = "Thêm danh mục thành công!";
            header('location:' . route("admin/danh_muc"));
        }
    }
    public function edit($id)
    {
        $data = $this->danhmucModel->getone_danhmuc($id);
        $title = "Cập nhật danh mục";
        // include_once "app/Views/edit.php";
        $this->render('admin.danh_muc.edit', compact('data', 'title'));
    }
    public function update($id)
    {
        $title = "Cập nhật danh mục";
        $ten_dm = $_POST['ten_dm'];
        $this->danhmucModel->update_danhmuc($id, $ten_dm);
        $_SESSION['success_message'] = "Cập nhật sản phẩm thành công!";
        header('location:' . route("admin/danh_muc"));
    }
    public function delete($id)
    {
        $this->danhmucModel->delete_danhmuc($id);
        $_SESSION['success_message'] = "Xóa thành công!";
        header('location:' . route("admin/danh_muc"));
    }
}
