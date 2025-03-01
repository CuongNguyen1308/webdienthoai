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
                                <img src="' . BASE_URL . 'public/uploads/' . $value['hinh'] . '" class="card-img-top"
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
                                    <a href="' . route('chi_tiet_san_pham/' . $value['id_sp'] . '/') . '"
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
    public function add_cart()
    {
        $id_ctsp = $_POST['id_ctsp'];
        $id_user = $_SESSION['user']['id_user'];
        $so_luong = $_POST['so_luong'];

        if (empty($id_ctsp) || empty($id_user) || empty($so_luong)) {
            // Xử lý lỗi nếu có
            echo "Tất cả các trường là bắt buộc!";
            return;
        }

        $this->giohangModel->add_cart($id_ctsp, $id_user, $so_luong);

        echo "Thêm thành công vào giỏ hàng";
    }
    public function updateQuantity() {
        $id_ctsp = $_POST['id_ctsp'];
        $so_luong = $_POST['so_luong'];
        $id_gh = $_POST['id_gh'];

        $this->giohangModel->update_giohang($id_gh,$id_ctsp,$so_luong);
        echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
    }
    public function updateVariant(){
        $id_ctsp = $_POST['id_ctsp'];
        $so_luong = $_POST['so_luong'];
        $so_luong_max = $_POST['so_luong_max'];
        $id_gh = $_POST['id_gh'];
        $id_user = $_SESSION['user']['id_user'];

        if (empty($id_ctsp) || empty($id_user) || empty($so_luong) || empty($id_gh)) {
            // Xử lý lỗi nếu có
            echo "Tất cả các trường là bắt buộc!";
            return;
        }

        $this->giohangModel->updateVariant($id_user,$id_gh,$id_ctsp,$so_luong,$so_luong_max);
        echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
    }
}
