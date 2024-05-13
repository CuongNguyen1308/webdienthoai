<?php
namespace App\Models;
use App\Models\db;
class Taikhoan extends db{
    public function danhsach_taikhoan(){
        $sql = "SELECT * FROM tai_khoan";
        return $this->pdo_query($sql);
    }
    public function getone_taikhoan($id_user){
        $sql = "SELECT * FROM tai_khoan WHERE id_user = $id_user";
        return $this->pdo_query_one($sql);
    }
    public function add_taikhoan($ho_ten,$email,$mat_khau,$so_dien_thoai,$dia_chi,$hinh){
        $sql = "INSERT INTO tai_khoan(ho_ten,email,mat_khau,so_dien_thoai,dia_chi,hinh) VALUE($ho_ten,$email,$mat_khau,$so_dien_thoai,$dia_chi,$hinh)";
        $this->pdo_execute($sql);
    }
    public function edit_taikhoan($id_user,$ho_ten,$email,$mat_khau,$so_dien_thoai,$dia_chi,$hinh,$pham_quyen){
        $sql = "UPDATE tai_khoan SET ho_ten =$ho_ten,email=$email,mat_khau=$mat_khau,so_dien_thoai=$so_dien_thoai,dia_chi=$dia_chi,hinh=$hinh,phan_quyen=$pham_quyen WHERE id_user =$id_user";
        $this->pdo_execute($sql);
    }
    public function edit_taikhoan_us($id_user,$ho_ten,$email,$so_dien_thoai,$dia_chi,$hinh){
        $sql = "UPDATE tai_khoan SET ho_ten =$ho_ten,email=$email,so_dien_thoai=$so_dien_thoai,dia_chi=$dia_chi,hinh=$hinh WHERE id_user =$id_user";
        $this->pdo_execute($sql);
    }
    public function delete_taikhoan($id_user){
        $sql = "DELETE FROM tai_khoan WHERE id_user = $id_user";
        $this->pdo_execute($sql);
    }
    public function login($email,$mat_khau){
        $sql = "SELECT * FROM tai_khoan WHERE email = '$email' and mat_khau = '$mat_khau'";
        return $this->pdo_query_one($sql);
    }
    public function check($email){
        $sql = "SELECT email FROM tai_khoan WHERE email = $email ";
        return $this->pdo_query_one($sql);
    }
    public function register($ho_ten,$email,$so_dien_thoai,$mat_khau){
        $sql = "INSERT INTO tai_khoan(ho_ten,email,so_dien_thoai,mat_khau) VALUE($ho_ten,$email,$so_dien_thoai,$mat_khau)";
        $this->pdo_execute($sql);
    }
}