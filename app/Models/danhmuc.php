<?php

namespace App\Models;

use App\Models\db;

class Danhmuc extends db
{
    public function danhsach_danhmuc(){
        $sql = "SELECT * FROM danh_muc";
        return $this->pdo_query($sql);
    }
    public function getone_danhmuc($id_dm){
        $sql = "SELECT * FROM danh_muc WHERE id_dm = $id_dm";
        return $this->pdo_query_one($sql);
    }
    public function add_danhmuc($ten_dm){
        $sql = "INSERT INTO danh_muc(ten_dm) VALUE('$ten_dm')";
        $this->pdo_execute($sql);
    }
    public function update_danhmuc($id_dm,$ten_dm){
        $sql = "UPDATE danh_muc SET ten_dm = '$ten_dm' WHERE id_dm = $id_dm ";
        $this->pdo_execute($sql);
    }
    public function chuyen_sp($id_dm){
        $sql = "UPDATE san_pham SET id_dm = 0 WHERE id_dm = id_dm";
        $this->pdo_execute($sql);
    }
    public function delete_danhmuc($id_dm){
        $sql = "DELETE FROM danh_muc WHERE id_dm = $id_dm";
        $this->pdo_execute($sql);
    }
}
