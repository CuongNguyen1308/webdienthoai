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

class CartController extends BaseController
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
    public function gio_hang() {
        $title = "Giỏ hàng";
        $items = $this->giohangModel->danhsach_giohang($_SESSION['user']['id_user']);
        foreach ($items as &$item) {
            $item['ctsp'] = $this->chitietsanphamModel->danhsach_ctsp($item['id_sp']); // Lấy biến thể cho từng sản phẩm
        }
        $this->render('user.giohang', compact('title','items'));
    }
    public function delete($id)
    {
        $this->giohangModel->delete_giohang($id);
        $_SESSION['success_message'] = "Xóa thành công một sản phẩm!";
        header('location:' . route("gio_hang"));
    }
    public function checkout(){
        $dsgh = $this->giohangModel->danhsach_thanhtoan($_POST['id_gh']);
        $_SESSION['san_pham'] = $dsgh;
        $_SESSION['cart'] = "true";
        // var_dump($dsgh);
        header('location:' . route("dat_hang"));
    }
}
