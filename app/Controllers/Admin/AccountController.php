<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Taikhoan;

class AccountController extends BaseController
{
    protected $taikhoanModel;

    public function __construct(){
        $this->taikhoanModel = new Taikhoan();

    }

    public function list(){
        $list=$this->taikhoanModel->danhsach_taikhoan();
        $title = "Danh sách tài khoản";
        $this->render('admin.tai_khoan.list',compact('list','title'));
    }

    public function add(){
        
    }
    public function create(){

    }
    public function delete(){

    }

}
