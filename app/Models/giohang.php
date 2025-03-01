<?php

namespace App\Models;

use App\Models\db;

class Giohang extends db
{
    public function dem_so_luong($id_user)
    {
        $sql = "SELECT COUNT(id_gh) as sp_gh FROM gio_hang WHERE id_user = $id_user";
        return $this->pdo_query_one($sql);
    }
    public function danhsach_giohang($id_user)
    {
        $sql = "SELECT gio_hang.id_gh as id_gh, tai_khoan.id_user as id_user, tai_khoan.dia_chi as dia_chi,gio_hang.so_luong as so_luong,chi_tiet_san_pham.id_ctsp as id_ctsp,chi_tiet_san_pham.id_sp as id_sp,chi_tiet_san_pham.dung_luong as dung_luong, chi_tiet_san_pham.mau_sac as mau_sac, chi_tiet_san_pham.so_luong as sl_ctsp,chi_tiet_san_pham.hinh as hinh,san_pham.ten_sp as ten_sp, san_pham.gia_goc as gia_goc , san_pham.giam_gia as giam_gia FROM gio_hang 
        INNER JOIN tai_khoan on gio_hang.id_user = tai_khoan.id_user 
        INNER JOIN chi_tiet_san_pham on gio_hang.id_ctsp=chi_tiet_san_pham.id_ctsp 
        INNER JOIN san_pham on chi_tiet_san_pham.id_sp=san_pham.id_sp WHERE gio_hang.id_user = $id_user";
        return $this->pdo_query($sql);
    }
    public function danhsach_thanhtoan($id_gh_array)
    {
        $id_gh_list = implode(',', array_map('intval', $id_gh_array));
        $sql = "SELECT gio_hang.id_gh as id_gh, tai_khoan.id_user as id_user, tai_khoan.dia_chi as dia_chi,gio_hang.so_luong as so_luong,chi_tiet_san_pham.id_ctsp as id_ctsp,chi_tiet_san_pham.id_sp as id_sp,chi_tiet_san_pham.dung_luong as dung_luong, chi_tiet_san_pham.mau_sac as mau_sac, chi_tiet_san_pham.so_luong as sl_ctsp,chi_tiet_san_pham.hinh as hinh,san_pham.ten_sp as ten_sp, san_pham.gia_goc as gia_goc , san_pham.giam_gia as giam_gia FROM gio_hang 
        INNER JOIN tai_khoan on gio_hang.id_user = tai_khoan.id_user 
        INNER JOIN chi_tiet_san_pham on gio_hang.id_ctsp=chi_tiet_san_pham.id_ctsp 
        INNER JOIN san_pham on chi_tiet_san_pham.id_sp=san_pham.id_sp WHERE gio_hang.id_gh in ($id_gh_list)";
        return $this->pdo_query($sql);
    }
    public function getone_gh($id_user, $id_gh)
    {
        $sql = "SELECT gio_hang.id_gh as id_gh, tai_khoan.id_user as id_user, tai_khoan.dia_chi as dia_chi,gio_hang.so_luong as so_luong,chi_tiet_san_pham.id_ctsp as id_ctsp,chi_tiet_san_pham.id_sp as id_sp,chi_tiet_san_pham.dung_luong as dung_luong, chi_tiet_san_pham.mau_sac as mau_sac, chi_tiet_san_pham.so_luong as sl_ctsp,chi_tiet_san_pham.hinh as hinh,san_pham.id_sp as id_sp,san_pham.ten_sp as ten_sp, san_pham.gia_goc as gia_goc , san_pham.giam_gia as giam_gia FROM gio_hang INNER JOIN tai_khoan on gio_hang.id_user = tai_khoan.id_user INNER JOIN chi_tiet_san_pham on gio_hang.id_ctsp=chi_tiet_san_pham.id_ctsp INNER JOIN san_pham on chi_tiet_san_pham.id_sp=san_pham.id_sp WHERE gio_hang.id_user = $id_user and gio_hang.id_gh = $id_gh";
        return $this->pdo_query_one($sql);
    }
    public function add_giohang($id_ctsp, $id_user, $so_luong)
    {
        $sql = "INSERT INTO gio_hang(id_ctsp,id_user,so_luong) VALUE($id_ctsp, $id_user, $so_luong)";
        $this->pdo_execute($sql);
    }
    public function delete_giohang($id_gh)
    {
        $sql = "DELETE FROM gio_hang WHERE id_gh=$id_gh";
        $this->pdo_execute($sql);
    }
    public function check_ctsp($id_ctsp, $id_user)
    {
        $sql = "SELECT * FROM gio_hang WHERE id_ctsp = $id_ctsp and id_user=$id_user";
        return $this->pdo_query_one($sql);
    }
    function cong_sp($id_ctsp, $so_luong, $id_user)
    {
        $sql = "UPDATE gio_hang SET so_luong = $so_luong WHERE id_ctsp = $id_ctsp and id_user=$id_user";
        $this->pdo_execute($sql);
    }
    public function update_giohang($id_gh, $id_ctsp, $so_luong)
    {
        $sql = "UPDATE gio_hang SET  id_ctsp=$id_ctsp,so_luong=$so_luong WHERE id_gh=$id_gh";
        $this->pdo_execute($sql);
    }
    public function add_cart($id_ctsp, $id_user, $so_luong)
    {
        // Check if the item already exists in the cart
        $existing_cart_item = $this->check_ctsp($id_ctsp, $id_user);

        if ($existing_cart_item) {
            // If it exists, update the quantity
            $new_quantity = $existing_cart_item['so_luong'] + $so_luong;
            $sql = "UPDATE gio_hang SET so_luong = $new_quantity WHERE id_ctsp = $id_ctsp AND id_user = $id_user";
            $this->pdo_execute($sql);
        } else {
            // If it doesn't exist, add the item to the cart
            $sql = "INSERT INTO gio_hang(id_ctsp, id_user, so_luong) VALUES($id_ctsp, $id_user, $so_luong)";
            $this->pdo_execute($sql);
        }
    }
    
    public function updateVariant($id_user,$id_gh, $id_ctsp, $so_luong ,$max_quantity)
    {
        $variant = $this->check_ctsp($id_ctsp, $id_user);
        if ($variant) {
            // Tăng số lượng nhưng không vượt quá max_quantity
            $new_quantity = min($variant['so_luong'] + $so_luong, $max_quantity);
            $id_gh_new =$variant['id_gh'];
            $sql = "UPDATE gio_hang SET so_luong = '$new_quantity' WHERE id_gh = $id_gh_new ";
            $this->pdo_execute($sql);

            if ($id_gh != $variant['id_gh']) {
                $this->delete_giohang($id_gh);
            }
        } else {
            // Nếu chưa có biến thể này, cập nhật trực tiếp
            $sql = "UPDATE gio_hang SET id_ctsp = $id_ctsp WHERE id_gh = $id_gh";
            $this->pdo_execute($sql);

        }
    }
}
