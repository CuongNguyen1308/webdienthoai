<?php

namespace App\Models;

use App\Models\db;

class Chitietsanpham extends db
{
    public function danhsach_ctsp($id_sp)
    {
        $sql = "SELECT *,chi_tiet_san_pham.hinh as hinh_ctsp FROM chi_tiet_san_pham INNER JOIN san_pham ON san_pham.id_sp=chi_tiet_san_pham.id_sp WHERE chi_tiet_san_pham.id_sp = $id_sp";
        return $this->pdo_query($sql);
    }

    public function getone_ctsp($id_ctsp)
    {
        $sql = "SELECT * FROM chi_tiet_san_pham WHERE id_ctsp = $id_ctsp";
        return $this->pdo_query_one($sql);
    }
    function add_ctsp($id_sp, $mau_sac, $dung_luong, $hinh, $so_luong)
    {
        $sql = "INSERT INTO chi_tiet_san_pham(id_sp,mau_sac,dung_luong,hinh,so_luong) VALUE('$id_sp', '$mau_sac', '$dung_luong', '$hinh', '$so_luong')";
        $this->pdo_execute($sql);
    }
    public function edit_ctsp($id_ctsp, $id_sp, $mau_sac, $dung_luong, $hinh, $so_luong)
    {
        $sql = "UPDATE chi_tiet_san_pham SET id_sp=$id_sp,mau_sac='$mau_sac',dung_luong='$dung_luong',hinh='$hinh',so_luong=$so_luong WHERE id_ctsp =$id_ctsp";
        $this->pdo_execute($sql);
    }
    public function delete_ctsp($id_ctsp)
    {
        $sql = "DELETE FROM chi_tiet_san_pham WHERE id_ctsp = $id_ctsp";
        $this->pdo_execute($sql);
    }
    public function doi_sl($id_ctsp, $so_luong)
    {
        $sql = "UPDATE chi_tiet_san_pham SET so_luong =$so_luong where id_ctsp =$id_ctsp";
        $this->pdo_execute($sql);
    }
    public function cap_nhat_so_luong($id_ctsp,$so_luong)
    {
        $ctsp = $this->getone_ctsp($id_ctsp);
        $so_luong_new = $ctsp['so_luong'] - $so_luong;

        $sql = "UPDATE chi_tiet_san_pham SET so_luong =$so_luong_new where id_ctsp =$id_ctsp";
        return $this->pdo_query_one($sql);
    }
}
