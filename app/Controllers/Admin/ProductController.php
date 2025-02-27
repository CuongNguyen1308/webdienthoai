<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Binhluan;
use App\Models\Chitietsanpham;
use App\Models\Danhmuc;
use App\Models\Giohang;
use App\Models\Hoadon;
use App\Models\Sanpham;
use App\Models\Taikhoan;

class ProductController extends BaseController
{
    protected $sanphamModel;
    protected $danhmucModel;
    protected $chitietsanphamModel;
    public function __construct(){
        $this->sanphamModel = new Sanpham();
        $this->danhmucModel = new Danhmuc();
        $this->chitietsanphamModel = new Chitietsanpham();
    }

    //lấy toàn bộ sản phẩm
    public function san_pham($page=1)
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
        $this->render('admin.san_pham.products',compact('products','title', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }
    public function add_sp(){
        $title = "Thêm sản phẩm";
        $ds_dm = $this->danhmucModel->danhsach_danhmuc();
        $this->render('admin.san_pham.add',compact('title','ds_dm'));
    }
    public function create_sp(){
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
            move_uploaded_file($_FILES["hinh"]["tmp_name"],"public/uploads/$hinh");
        }
        $id_dm = $_POST['id_dm'];
        if(empty($ten_sp) || empty($mo_ta)){
            $thongbao = "Vui lòng nhập đủ thông tin";
            $this->render('admin.san_pham.add',compact('title','ds_dm','thongbao'));
        } else{
            $this->sanphamModel->create_sp($ten_sp,$gia_goc,$giam_gia,$mo_ta,$hinh,$ngay_dang,$id_dm);
            header('location:'.route("admin/san_pham"));
        }
        
    }
    public function edit_sp($id_sp){
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = "Sửa sản phẩm";
        $_SESSION['hinh'] = $sanpham['hinh'];
        $ds_dm = $this->danhmucModel->danhsach_danhmuc();
        // include_once "app/Views/edit.php";
        $this->render('admin.san_pham.edit',compact('sanpham','title','ds_dm'));

    }
    public function update_sp($id_sp){
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
        header('location:'.route("admin/san_pham"));
    }
    public function delete_sp($id_sp){
        $this->sanphamModel->delete_sp($id_sp);
        header('location:'.route("admin/san_pham"));
    }
    
}
