<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Chitietsanpham;
use App\Models\Danhmuc;
use App\Models\Sanpham;

class ProductController extends BaseController
{
    protected $sanphamModel;
    protected $danhmucModel;
    protected $chitietsanphamModel;
    public function __construct()
    {
        $this->sanphamModel = new Sanpham();
        $this->danhmucModel = new Danhmuc();
        $this->chitietsanphamModel = new Chitietsanpham();
    }

    //lấy toàn bộ sản phẩm
    public function san_pham($page = 1)
    {
        //xử lý logic, validate dữ liệu
        $title = "Danh sách sản phẩm";
        $tongrecord = $this->sanphamModel->tong_trang();
        if (isset($_GET['page'])) $page = $_GET['page'];
        $row = 5;
        $start = ($page - 1) * $row;
        $offset = 3;
        $tongsotrang = ceil($tongrecord['tongrecord'] / $row);
        $from = $page - $offset;
        if ($from < 1) $from = 1;
        $to = $page + $offset;
        if ($to > $tongsotrang) $to = $tongsotrang;
        $pagenext = $page + 1;
        $pagepre = $page - 1;
        $products = $this->sanphamModel->phan_trang($start, $row);
        // include "app/Views/products.php";
        $this->render('admin.san_pham.products', compact('products', 'title', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }
    public function add_sp()
    {
        $title = "Thêm sản phẩm";
        $ds_dm = $this->danhmucModel->danhsach_danhmuc();
        $this->render('admin.san_pham.add', compact('title', 'ds_dm'));
    }
    public function create_sp()
    {
        $title = "Thêm sản phẩm";
        $ds_dm = $this->danhmucModel->danhsach_danhmuc();
        $ten_sp = $_POST['ten_sp'];
        $gia_goc = $_POST['gia_goc'];
        $giam_gia = $_POST['giam_gia'];
        $mo_ta = $_POST['mo_ta'];
        $hinh = '';
        $date = getdate();
        $ngay_dang = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . ($date['hours']) . ':' . $date['minutes'] . ':' . $date['seconds'];
        if ($_FILES['hinh']['name'] !== '') {
            $hinh = time() . "_" . $_FILES["hinh"]["name"];
            move_uploaded_file($_FILES["hinh"]["tmp_name"], "public/uploads/$hinh");
        }
        $id_dm = $_POST['id_dm'];
        if (empty($ten_sp) || empty($mo_ta)) {
            $thongbao = "Vui lòng nhập đủ thông tin";
            $this->render('admin.san_pham.add', compact('title', 'ds_dm', 'thongbao'));
        } else {
            $this->sanphamModel->create_sp($ten_sp, $gia_goc, $giam_gia, $mo_ta, $hinh, $ngay_dang, $id_dm);
            $_SESSION['success_message'] = "Thêm sản phẩm thành công!";
            header('location:' . route("admin/san_pham"));
        }
    }
    public function edit_sp($id_sp)
    {
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = "Sửa sản phẩm";
        $_SESSION['hinh'] = $sanpham['hinh'];
        $ds_dm = $this->danhmucModel->danhsach_danhmuc();
        // include_once "app/Views/edit.php";
        $this->render('admin.san_pham.edit', compact('sanpham', 'title', 'ds_dm'));
    }
    public function update_sp($id_sp)
    {
        $ten_sp = $_POST['ten_sp'];
        $gia_goc = $_POST['gia_goc'];
        $giam_gia = $_POST['giam_gia'];
        $mo_ta = $_POST['mo_ta'];
        $id_dm = $_POST['id_dm'];
        if ($_FILES['hinh']['name'] == "") {
            $hinh = $_SESSION['hinh'];
            move_uploaded_file($_FILES['hinh']['tmp_name'], "public/uploads/$hinh");
        } else {
            $hinh = time() . "_" . $_FILES['hinh']['name'];
            move_uploaded_file($_FILES['hinh']['tmp_name'], "public/uploads/$hinh");
        }
        $this->sanphamModel->update_sp($id_sp, $ten_sp, $gia_goc, $giam_gia, $mo_ta, $hinh, $id_dm);
        $_SESSION['success_message'] = "Cập nhật sản phẩm thành công!";
        header('location:' . route("admin/san_pham"));
    }
    public function delete_sp($id_sp)
    {
        $this->sanphamModel->delete_sp($id_sp);
        $_SESSION['success_message'] = "Xóa sản phẩm thành công!";
        header('location:' . route("admin/san_pham"));
    }

    // Ctsp
    public function ctsp($id_sp)
    {
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = "Danh sách biến thể - " . $sanpham['ten_sp'];
        $list = $this->chitietsanphamModel->danhsach_ctsp($id_sp);

        $this->render('admin.san_pham.bien_the.list',compact('title','list','sanpham'));
    }
    public function add_ctsp($id_sp){
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = "Thêm biến thể";
        $this->render('admin.san_pham.bien_the.add', compact('title','sanpham'));
    }
    public function create_ctsp($id_sp){
        foreach ($_POST['mau_sac']  as $key => $mau_sac) {
            $dung_luong = $_POST['dung_luong'][$key];
            $so_luong = $_POST['so_luong'][$key];
            if ($_FILES['hinh']['name'][$key] !== '') {
                $hinh = time() . "_" . $_FILES["hinh"]["name"][$key];
                move_uploaded_file($_FILES["hinh"]["tmp_name"][$key], "public/uploads/$hinh");
            }
            // var_dump($id_sp,$mau_sac,$dung_luong,$hinh,$so_luong);
            $this->chitietsanphamModel->add_ctsp($id_sp,$mau_sac,$dung_luong,$hinh,$so_luong);
        }
        $_SESSION['success_message'] = "Thêm biến thể sản phẩm thành công!";
        header('location:' . route("admin/san_pham"));
    }
    public function edit_ctsp($id_sp){
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = "Cập nhật biến thể sản phẩm";
        $list = $this->chitietsanphamModel->danhsach_ctsp($id_sp);

        $this->render('admin.san_pham.bien_the.edit', compact('sanpham', 'title', 'list'));
    }
    public function update_ctsp($id_sp){
        foreach ($_POST['mau_sac'] as $key => $mau_sac) {
            $id_ctsp = $_POST['id_ctsp'][$key];
            $dung_luong = $_POST['dung_luong'][$key];
            $so_luong = $_POST['so_luong'][$key];
            $hinh = $_POST['old_hinh'][$key]; // Mặc định lấy ảnh cũ
    
            // Nếu có ảnh mới thì cập nhật
            if (!empty($_FILES['hinh']['name'][$key])) {
                $hinh = time() . "_" . $_FILES["hinh"]["name"][$key];
                move_uploaded_file($_FILES["hinh"]["tmp_name"][$key], "public/uploads/$hinh");
            }
    
            // Cập nhật vào database
            $this->chitietsanphamModel->edit_ctsp($id_ctsp, $id_sp,$mau_sac, $dung_luong, $hinh, $so_luong);
        }
    
        $_SESSION['success_message'] = "Cập nhật biến thể sản phẩm thành công!";
        header('location:' . route("admin/san_pham"));
    }
    public function delete_ctsp($id){
        $this->chitietsanphamModel->delete_ctsp($id);
        $_SESSION['success_message'] = "Xóa biến thể sản phẩm thành công!";
        header('location:' . route("admin/san_pham"));
    }
}
