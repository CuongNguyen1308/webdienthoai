<?php

namespace App\Models;

use App\Models\db;

class Sanpham extends db
{
    //lấy toàn bộ sp ở trong CSDL
    public function listProduct()
    {
        $query = "SELECT * FROM san_pham inner join danh_muc ON danh_muc.id_dm = san_pham.id_dm";

        return $this->pdo_query($query);
    }
    public function san_pham()
    {

        $query = "SELECT * FROM san_pham inner join danh_muc ON danh_muc.id_dm = san_pham.id_dm limit 0,12";

        return $this->pdo_query($query);
    }
    public function getById($id_sp)
    {
        $query = "SELECT * FROM san_pham WHERE id_sp = $id_sp";

        return $this->pdo_query_one($query);
    }
    function create_sp($ten_sp, $gia_goc, $giam_gia, $mo_ta, $hinh, $ngay_dang, $id_dm)
    {
        $sql = "INSERT INTO san_pham(ten_sp,gia_goc,giam_gia,mo_ta,hinh,ngay_dang,id_dm) VALUE('$ten_sp', $gia_goc, $giam_gia, '$mo_ta', '$hinh', '$ngay_dang', $id_dm)";
        $this->pdo_execute($sql);
    }
    public function update_sp($id_sp, $ten_sp, $gia_goc, $giam_gia, $mo_ta, $hinh, $id_dm)
    {
        $query = "UPDATE san_pham SET ten_sp= '$ten_sp',gia_goc=$gia_goc,giam_gia=$giam_gia,mo_ta='$mo_ta',hinh='$hinh',id_dm='$id_dm' WHERE id_sp = '$id_sp'";
        $this->pdo_execute($query);
    }
    public function delete_sp($id)
    {
        $query = "DELETE FROM san_pham WHERE id_sp=$id";
        $this->pdo_execute($query);
    }
    public function khuyen_mai()
    {
        $sql = "SELECT * FROM san_pham where giam_gia > 0 ORDER BY giam_gia DESC LIMIT 0,12";
        return $this->pdo_query($sql);
    }
    public function loc_sanpham()
    {
        $where = '1';
        $loc = '';
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $row = 12;
        $start = ($page - 1) * $row;
        if (isset($_POST['loc'])) {
            if ($_POST['loc'] == 'thap-cao') {
                $loc = 'ORDER BY san_pham.gia_goc asc';
            } else if ($_POST['loc'] == 'cao-thap') {
                $loc = 'ORDER BY san_pham.gia_goc desc';
            }
        }
        $and = '';
        if (isset($_POST['action'])) {
            if (isset($_POST['minimum_price'], $_POST['maximum_price']) && !empty($_POST['minimum_price']) && !empty($_POST['maximum_price'])) {
                $minimum_price = $_POST['minimum_price'];
                $maximum_price = $_POST['maximum_price'];
                $and .= " AND san_pham.gia_goc BETWEEN $minimum_price AND $maximum_price";
            }
            if (isset($_POST['brand'])) {
                $brand_filter = $brand_filter = implode("','", $_POST['brand']);
                $and .= " AND san_pham.id_dm IN('" . $brand_filter . "')";
            }
        }
        if (isset($_POST['tim_kiem'])) {
            $tim_kiem = $_POST['tim_kiem'];
            $where = " san_pham.ten_sp LIKE '%$tim_kiem%'";
        }
        if (isset($_GET['id_dm'])) {
            $id_dm = $_GET['id_dm'];
            $where = " san_pham.id_dm = $id_dm";
        }
        $sql = "SELECT * FROM san_pham INNER JOIN danh_muc ON danh_muc.id_dm = san_pham.id_dm WHERE $where $and $loc  LIMIT $start,$row ";
        return $this->pdo_query($sql);
    }

    public function top5()
    {
        $sql = 'SELECT * FROM san_pham WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0,5';
        return $this->pdo_query($sql);
    }
    public function sanpham_lienquan($id_dm, $id_sp)
    {
        $sql = "SELECT * FROM san_pham WHERE id_dm = $id_dm AND id_sp != $id_sp LIMIT 0,4";
        return $this->pdo_query($sql);
    }
    public function phan_trang($start, $row)
    {
        $sql = "SELECT * FROM san_pham inner join danh_muc ON danh_muc.id_dm = san_pham.id_dm LIMIT $start,$row";
        return $this->pdo_query($sql);
    }
    public function tong_trang()
    {
        $sql = "SELECT COUNT(*) as tongrecord FROM san_pham";
        return $this->pdo_query_one($sql);
    }
    public function ajaxLocSanPham($filters)
    {
        $where = '1';
        $loc = '';

        // Lọc theo giá
        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $min_price = (int) $filters['min_price'];
            $max_price = (int) $filters['max_price'];
            $where .= " AND san_pham.gia_goc BETWEEN $min_price AND $max_price";
        }

        // Lọc theo danh mục
        if (!empty($filters['danh_muc']) && is_array($filters['danh_muc'])) {
            $danh_muc = array_map('intval', $filters['danh_muc']); // Ép kiểu số nguyên
            $category_list = implode(',', $danh_muc);
            $where .= " AND san_pham.id_dm IN ($category_list)";
        }

        // Sắp xếp
        if (!empty($filters['sort'])) {
            if ($filters['sort'] == 'thap-cao') {
                $loc = " ORDER BY san_pham.gia_goc ASC";
            } elseif ($filters['sort'] == 'cao-thap') {
                $loc = " ORDER BY san_pham.gia_goc DESC";
            }
        }

        // Tạo truy vấn SQL hoàn chỉnh
        $sql = "SELECT * FROM san_pham INNER JOIN danh_muc ON danh_muc.id_dm = san_pham.id_dm 
        WHERE $where $loc LIMIT 12";

        return $this->pdo_query($sql);
    }
}
