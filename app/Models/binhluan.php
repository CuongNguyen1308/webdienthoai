<?php

namespace App\Models;

use App\Models\db;

class Binhluan extends db
{
    public function danhsach_binhluan()
    {
        $sql = "SELECT san_pham.ten_sp as ten_sp,COUNT(binh_luan.id_bl) as so_luot_bl FROM binh_luan INNER JOIN tai_khoan ON binh_luan.id_user = tai_khoan.id_user INNER JOIN san_pham ON binh_luan.id_sp = san_pham.id_sp";
        return $this->pdo_query($sql);
    }
    public function danhsach_blsp($id_sp)
    {
        $sql = "SELECT * FROM binh_luan INNER JOIN tai_khoan ON binh_luan.id_user = tai_khoan.id_user INNER JOIN san_pham ON binh_luan.id_sp = san_pham.id_sp WHERE binh_luan.id_sp = $id_sp";
        return $this->pdo_query($sql);
    }
    public function danhsach_bl_us($id_sp)
    {
        $sql = "SELECT binh_luan.id_sp as id_sp, tai_khoan.ho_ten as ho_ten,tai_khoan.hinh as hinh, binh_luan.noi_dung as noi_dung,binh_luan.ngay_dang as ngay_dang FROM binh_luan INNER JOIN tai_khoan ON binh_luan.id_user = tai_khoan.id_user INNER JOIN san_pham ON binh_luan.id_sp = san_pham.id_sp WHERE binh_luan.id_sp = $id_sp LIMIT 0,5 ";
        return $this->pdo_query($sql);
    }
    public function add_binhluan($id_user, $id_sp, $noi_dung, $ngay_dang)
    {
        $sql = "INSERT INTO binh_luan(id_user,id_sp,noi_dung,ngay_dang) VALUE($id_user, $id_sp, $noi_dung, $ngay_dang)";
        $this->pdo_execute($sql);
    }
    public function delete_binhluan($id_bl)
    {
        $sql = "delete from binh_luan where ma_bl= $id_bl";
        $this->pdo_execute($sql);
    }
}
