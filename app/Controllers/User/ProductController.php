<?php

namespace App\Controllers\User;

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
    protected $taikhoanModel;
    protected $chitietsanphamModel;
    protected $giohangModel;
    protected $binhluanModel;
    protected $hoadonModel;

    public function __construct()
    {
        $this->sanphamModel = new Sanpham();
        $this->danhmucModel = new Danhmuc();
        $this->giohangModel = new Giohang();
        $this->binhluanModel = new Binhluan();
        $this->chitietsanphamModel = new Chitietsanpham();
        $this->taikhoanModel = new Taikhoan();
        $this->hoadonModel = new Hoadon();
    }
    //lấy toàn bộ sản phẩm
    public function trang_chu()
    {
        $title = "Trang chủ";
        $danhmuc = $this->danhmucModel->danhsach_danhmuc();
        $khuyenmai = $this->sanphamModel->khuyen_mai();
        $sanpham = $this->sanphamModel->san_pham();
        $this->render('user.trangchu', compact('title', 'khuyenmai', 'sanpham', 'danhmuc'));
    }
    public function san_pham()
    {
        $title = "Sản phẩm";
        $danhmuc = $this->danhmucModel->danhsach_danhmuc();

        $top_5 = $this->sanphamModel->top5();
        $tongrecord = $this->sanphamModel->tong_trang();
        if (!isset($_GET['page'])) $page = 1;
        $row = 12;
        $start = ($page - 1) * $row;
        $offset = 3;
        $tongsotrang = ceil($tongrecord['tongrecord'] / $row);
        $from = $page - $offset;
        if ($from < 1) $from = 1;
        $to = $page + $offset;
        if ($to > $tongsotrang) $to = $tongsotrang;
        $pagenext = $page + 1;
        $pagepre = $page - 1;
        $sanpham = $this->sanphamModel->phan_trang($start, $row);
        $this->render('user.sanpham', compact('title', 'danhmuc', 'sanpham', 'top_5', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }
    public function danh_muc($id_dm)
    {
        $title = "Sản phẩm theo danh mục";
        $danhmuc = $this->danhmucModel->danhsach_danhmuc();

        $top_5 = $this->sanphamModel->top5();
        $tongrecord = $this->sanphamModel->tong_trang($id_dm);
        if (!isset($_GET['page'])) $page = 1;
        $row = 12;
        $start = ($page - 1) * $row;
        $offset = 3;
        $tongsotrang = ceil($tongrecord['tongrecord'] / $row);
        $from = $page - $offset;
        if ($from < 1) $from = 1;
        $to = $page + $offset;
        if ($to > $tongsotrang) $to = $tongsotrang;
        $pagenext = $page + 1;
        $pagepre = $page - 1;
        $sanpham = $this->sanphamModel->phan_trang($start, $row,$id_dm);
        
        $this->render('user.sanpham', compact('title', 'danhmuc', 'sanpham', 'top_5', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }
    public function chi_tiet_san_pham($id_sp)
    {
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = $sanpham['ten_sp'];
        $ctsp = $this->chitietsanphamModel->danhsach_ctsp($id_sp);

        $ds_bl = $this->binhluanModel->danhsach_bl_us($id_sp);
        $sanphamlq = $this->sanphamModel->sanpham_lienquan($sanpham['id_dm'], $sanpham['id_sp']);

        $this->render('user.chitietsanpham', compact('sanpham', 'title', 'ctsp', 'ds_bl', 'sanphamlq'));
    }
    public function chi_tiet_san_pham_cau_hinh($id_sp, $id_ctsp)
    {
        $sanpham = $this->sanphamModel->getById($id_sp);
        $title = $sanpham['ten_sp'];
        $ctsp = $this->chitietsanphamModel->danhsach_ctsp($id_sp);
        $ds_bl = $this->binhluanModel->danhsach_bl_us($id_sp);
        $sanphamlq = $this->sanphamModel->sanpham_lienquan($sanpham['id_dm'], $sanpham['id_sp']);
        $this->render('user.chitietsanpham', compact('sanpham', 'title', 'ctsp', 'ds_bl', 'sanphamlq', 'id_ctsp'));
    }
    public function gui_du_lieu($id_sp)
    {
        
        $sanpham = $this->sanphamModel->getById($id_sp);
        
        if (isset($_POST['mua_ngay'])) {
            // $thong_bao = 'Chọn cấu hình đi chứ ';
            $_SESSION['san_pham'] = $sanpham;
            $_SESSION['ctsp'] = $this->chitietsanphamModel->getone_ctsp($_POST['id_ctsp'][0]);
            $_SESSION['so_luong'] = $_POST['so_luong'][0];
            header('location:' . route("dat_hang"));
        }
        if (isset($_POST['them_vao_gio'])) {
            // $thong_bao = 'Chưa chọn cấu hình';
            // $this->render('user.chitietsanpham', compact('sanpham', 'title', 'ctsp', 'ds_bl', 'sanphamlq','thong_bao'));
        }
    }
    
    public function view_thong_tin(){
        $title = "Thanh toán sản phẩm";
        $this->render("user.dathang",compact('title'));
    }
    public function dat_hang(){
        if (isset($_POST['dat_hang'])) {
            $ngay = date('Y-m-d');
            $id_hd = $this->hoadonModel->add_hoadon($_SESSION['user']['id_user'], $_POST['ho_ten'], $_POST['email'], $_POST['so_dien_thoai'], $_POST['dia_chi'], $ngay);
            $this->hoadonModel->add_cthd($id_hd, $_POST['id_sp'], $_POST['mau_sac'], $_POST['dung_luong'], $_POST['so_luong'], $_POST['gia_ban']);
            header('location:' . route(""));
        }
    }
    public function don_hang(){
        $title = "Đơn hàng của bạn";
        $ds_hd = $this->hoadonModel->danh_sach_cthd($_SESSION['user']['id_user']);
        $this->render("user.donhang",compact('ds_hd','title'));
    }
    public function phan_trang($page)
    {
        $title = "Sản phẩm";
        $danhmuc = $this->danhmucModel->danhsach_danhmuc();
        $top_5 = $this->sanphamModel->top5();
        $tongrecord = $this->sanphamModel->tong_trang();

        $row = 12;
        $start = ($page - 1) * $row;
        $offset = 3;
        $tongsotrang = ceil($tongrecord['tongrecord'] / $row);
        $from = $page - $offset;
        if ($from < 1) $from = 1;
        $to = $page + $offset;
        if ($to > $tongsotrang) $to = $tongsotrang;
        $pagenext = $page + 1;
        $pagepre = $page - 1;
        $sanpham = $this->sanphamModel->phan_trang($start, $row);
        $this->render('user.sanpham', compact('title', 'danhmuc', 'sanpham', 'top_5', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }

    public function login()
    {
        $title = "Đăng nhập";
        $this->render('user.login', compact('title'));
    }
    public function checklogin()
    {
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];
        $login = $this->taikhoanModel->login($email, $mat_khau);
        if (is_array($login)) {
            $_SESSION['user'] = $login;
            header('location:' . route(""));
        } else {
            $thongbao = 'tài khoản hoặc mật khẩu không hợp lệ';
            $this->render('user.login', compact('thongbao'));
        }
    }
    public function acount()
    {
        $title = "Thông tin tài khoản";
        $this->render('user.acount', compact('title'));
    }
    public function logout()
    {
        unset($_SESSION['user']);
        header('location:' . route(""));
    }
}
