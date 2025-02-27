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
        $row = 8;
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

    public function add(){
        
    }
    public function create(){

    }
    public function delete(){

    }

}
