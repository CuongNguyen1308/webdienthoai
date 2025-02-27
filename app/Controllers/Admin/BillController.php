<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Hoadon;

class BillController extends BaseController
{
    protected $hoadonModel;

    public function __construct(){
        $this->hoadonModel = new Hoadon();

    }

    public function hoa_don($page=1){
        $title = "Danh sách hóa đơn";

        $tongrecord = $this->hoadonModel->tong_trang();
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
        $hoadon = $this->hoadonModel->danh_sach_hoa_don($start, $row);
        $this->render('admin.don_hang.dh',compact('hoadon', 'row', 'start', 'tongsotrang', 'from', 'to', 'pagenext', 'pagepre'));
    }
    public function cthd($id_hd){
        $title = "Chi tiết hóa đơn";
        $cthd = $this->hoadonModel->dscthd($id_hd);
        $this->render('admin.don_hang.ctdh',compact('title','cthd'));
    }


    public function edit($id_hd){
        $title = "Cập nhật đơn hàng";
        $trangthai = $this->hoadonModel->trang_thai();
        $donhang = $this->hoadonModel->getone_hoadon($id_hd);
        $this->render('admin.don_hang.trangthai',compact('title','trangthai','donhang'));
    }
    public function update($id_hd){
        $trangthai = $_POST['trang_thai'];
        $this->hoadonModel->update_hoadon($id_hd,$trangthai);
        $_SESSION['success_message'] = "Cập nhật trạng thái thành công!";
        header('location:' . route(url: "admin/don_hang"));
    }
}
