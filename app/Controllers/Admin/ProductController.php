<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Binhluan;
use App\Models\Chitietsanpham;
use App\Models\Danhmuc;
use App\Models\Giohang;
use App\Models\Hoadon;
use App\Models\Product;
use App\Models\Taikhoan;

class ProductController extends BaseController
{
    protected $productModel;
    protected $danhmucModel;
    protected $taikhoanModel;
    protected $chitietsanphamModel;
    protected $giohangModel;
    protected $binhluanModel;
    protected $hoadonModel;
    public function __construct(){
        $this->productModel = new Product();
        $this->danhmucModel = new Danhmuc();
        $this->giohangModel = new Giohang();
        $this->binhluanModel = new Binhluan();
        $this->chitietsanphamModel = new Chitietsanpham();
        $this->taikhoanModel = new Taikhoan();
        $this->hoadonModel = new Hoadon();
    }

    public function danh_muc(){
        $listdm=$this->danhmucModel->danhsach_danhmuc();
        $title = "Danh sách danh mục";
        $this->render('admin.danh_muc.list',compact('listdm','title'));
    }
    //lấy toàn bộ sản phẩm
    public function san_pham()
    {
        //xử lý logic, validate dữ liệu
        $products = $this->productModel->listProduct();
        $title = "Danh sách sản phẩm";
        // include "app/Views/products.php";
        $this->render('admin.san_pham.products',compact('products','title'));
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
            $this->productModel->create_sp($ten_sp,$gia_goc,$giam_gia,$mo_ta,$hinh,$ngay_dang,$id_dm);
            header('location:'.route("admin/san_pham"));
        }
        
    }
    public function edit_sp($id_sp){
        $sanpham = $this->productModel->getById($id_sp);
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
        $this->productModel->update_sp($id_sp, $ten_sp, $gia_goc, $giam_gia, $mo_ta, $hinh, $id_dm);
        header('location:'.route("admin/san_pham"));
    }
    public function delete_sp($id_sp){
        $this->productModel->delete_sp($id_sp);
        header('location:'.route("admin/san_pham"));
    }
    public function hoa_don(){
        $title = "Danh sách hóa đơn";
        $hoadon = $this->hoadonModel->danh_sach_hoa_don();
        $this->render('admin.don_hang.dh',compact('hoadon'));
    }
    public function cthd($id_hd){
        $title = "Chi tiết hóa đơn";
        $cthd = $this->hoadonModel->dscthd($id_hd);
        $this->render('admin.don_hang.ctdh',compact('title','cthd'));
    }
}
