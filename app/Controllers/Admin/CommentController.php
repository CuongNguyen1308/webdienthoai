<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Binhluan;

class CommentController extends BaseController
{
    protected $binhluanModel;

    public function __construct()
    {
        $this->binhluanModel = new Binhluan();
    }

    public function list()
    {
        $title = "Danh sách bình luận";
        $list = $this->binhluanModel->danhsach_binhluan();
        $this->render('admin.binh_luan.bl', compact('list', 'title'));
    }
    public function list_bl($id_sp){
        $title = "Danh sách bình luận";
        $list = $this->binhluanModel->danhsach_bl_us($id_sp);
        $this->render('admin.binh_luan.blsp', compact('list', 'title'));
    }
    public function delete($id){
        $this->binhluanModel->delete_binhluan($id);
        $_SESSION['success_message'] = "Xóa bình luận sản phẩm thành công!";
        header('location:' . route("admin/binh_luan"));
    }
}
