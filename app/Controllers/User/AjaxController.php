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

class AjaxController extends BaseController
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
    public function filter()
    {
        $output = '';
        $filters = [
            'min_price' => $_POST['min_price'] ?? null,
            'max_price' => $_POST['max_price'] ?? null,
            'danh_muc' => $_POST['danh_muc'] ?? [],
            'search' => $_POST['search'] ?? '',
            'sort' => $_POST['sort'] ?? '',
            'page' => $_POST['page'] ?? 1
        ];
        
        $products = $this->sanphamModel->ajaxLocSanPham($filters);
        // var_dump($this->sanphamModel->ajaxLocSanPham($filters));
        // die;
        foreach ($products as $key => $value) {
            $output .= '
            <div class="col">
                            <div class="card position-relative" style="width: 14rem; height: 420px;">
                                <img src="'. BASE_URL .'public/uploads/' . $value['hinh'] . '" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $value['ten_sp'] . '</h5>
                                    <div class="d-flex gap-2">
                                        <p class="text-danger fw-bold">
                                            ' . number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) . '
                                        </p>
                                        <span
                                            class="text-decoration-line-through">' . number_format($value['gia_goc']) . '</span>
                                    </div>
                                    <p class="card-text " style="width = 100%; height = 50px;">' . $value['mo_ta'] . '</p>
                                    <a href="{{ route("chi_tiet_san_pham/' . $value['id_sp'] . '/") }}"
                                        class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x"
                                        style="margin-bottom:20px;">Mua ngay</a>
                                </div>
                            </div>
                        </div>
        ';
        }
        echo $output;
        // return json_encode([
        //     'sanpham' => $products,
        // ]);
    }
}
