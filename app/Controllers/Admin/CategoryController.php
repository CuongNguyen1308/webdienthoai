<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Danhmuc;

class CategoryController extends BaseController
{
    protected $danhmucModel;

    public function __construct(){
        $this->danhmucModel = new Danhmuc();

    }

    public function danh_muc(){
        $listdm=$this->danhmucModel->danhsach_danhmuc();
        $title = "Danh sách danh mục";
        $this->render('admin.danh_muc.list',compact('listdm','title'));
    }

    public function add(){
        
    }
    public function create(){

    }
    public function delete(){

    }

}
