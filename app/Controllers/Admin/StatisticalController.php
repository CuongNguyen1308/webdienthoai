<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Hoadon;

class StatisticalController extends BaseController
{
    protected $hoadonModel;

    public function __construct()
    {
        $this->hoadonModel = new Hoadon();
    }

    public function thong_ke()
    {
        $thang = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');  // Ép kiểu an toàn
        // Lấy thống kê tổng đơn hàng, tổng doanh thu, tổng sản phẩm bán
        $thongke_tong = $this->hoadonModel->thongke_donhang($thang);

        // Lấy thống kê đơn hàng theo từng tháng
        $thongke_theothang = $this->hoadonModel->load_thongke_donhang($thang);
        $this->render('admin.thongke',compact('thongke_tong','thongke_theothang'));
    }

}
