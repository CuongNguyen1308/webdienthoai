<?php
namespace App\Models;
use App\Models\db;
class Hoadon extends db{
    public function fix_hoadon($id_user){
        $sql = "SELECT * FROM hoa_don INNER JOIN trang_thai on hoa_don.trang_thai = trang_thai.id_tt WHERE id_user = $id_user ORDER BY id_hd desc";
        return $this->pdo_query($sql);
    }
    public function fix_cthd($id_hd){
        $sql = "SELECT * FROM chi_tiet_hoa_don INNER JOIN san_pham on chi_tiet_hoa_don.id_sp = san_pham.id_sp WHERE chi_tiet_hoa_don.id_hd = $id_hd  ";
        return $this->pdo_query($sql);
    }
    //
    public function danh_sach_hoa_don($start=0,$row=4){
        $sql = "SELECT * from hoa_don inner join trang_thai on trang_thai.id_tt=hoa_don.trang_thai LIMIT $start,$row";
        return $this->pdo_query($sql);
    }
    public function phan_trang($start,$row){
        $sql = "SELECT * FROM hoa_don inner inner join trang_thai on trang_thai.id_tt=hoa_don.trang_thai LIMIT $start,$row";
        return $this->pdo_query($sql);
    }
    public function getone_hoadon($id_hd){
        $sql = "SELECT * FROM hoa_don WHERE id_hd =$id_hd";
        return $this->pdo_query_one($sql);
    }
    public function update_hoadon($id_hd,$trang_thai){
        $sql ="UPDATE hoa_don SET trang_thai =$trang_thai WHERE id_hd=$id_hd";
        $this->pdo_execute($sql);
    }
    public function trang_thai(){
        $sql = "SELECT * FROM trang_thai";
        return $this->pdo_query($sql);
    }
    function add_hoadon($id_user,$ho_ten,$email,$so_dien_thoai,$dia_chi,$ngay_dat){
        $conn = $this->getConnect();
        $sql = "INSERT INTO hoa_don(id_user,ho_ten,email,so_dien_thoai,dia_chi,ngay_dat) VALUE(?,?,?,?,?,?)";
        $stmt = $conn -> prepare($sql);
        $stmt ->execute([$id_user,$ho_ten,$email,$so_dien_thoai,$dia_chi,$ngay_dat]);
        $lastID = $conn -> lastInsertId();
        return $lastID;
    }
    public function add_cthd($id_hd,$id_sp,$mau_sac,$dung_luong,$so_luong,$gia_ban){
        $sql = "INSERT INTO chi_tiet_hoa_don(id_hd,id_sp,mau_sac,dung_luong,so_luong,gia_ban) VALUE($id_hd,$id_sp,'$mau_sac','$dung_luong',$so_luong,$gia_ban)";
        $this->pdo_execute($sql);
    }
    public function danh_sach_cthd($id_user){
        $sql = "SELECT 
            hd.id_hd AS id_hd, 
            hd.ngay_dat AS ngay_dat, 
            hd.ho_ten AS ho_ten,
            hd.so_dien_thoai AS so_dien_thoai,
            hd.dia_chi AS dia_chi, 
            tt.ten_tt AS trang_thai,
            tt.id_tt AS id_tt,
            SUM(cthd.gia_ban * cthd.so_luong) AS tong_tien,
            GROUP_CONCAT(
                CONCAT(sp.ten_sp, ' - ', cthd.mau_sac, ' - ', cthd.dung_luong, ' - SL:', cthd.so_luong, ' - Giá:', cthd.gia_ban) 
                SEPARATOR ' | '
            ) AS danh_sach_san_pham
        FROM chi_tiet_hoa_don AS cthd 
        INNER JOIN hoa_don AS hd ON cthd.id_hd = hd.id_hd 
        INNER JOIN san_pham AS sp ON cthd.id_sp = sp.id_sp 
        INNER JOIN trang_thai AS tt ON hd.trang_thai = tt.id_tt 
        WHERE hd.id_user = $id_user 
        GROUP BY hd.id_hd
        ORDER BY hd.id_hd DESC";

        return $this->pdo_query($sql);
    }
    public function dscthd($id_hd){
        $sql= "SELECT * FROM chi_tiet_hoa_don INNER JOIN san_pham on chi_tiet_hoa_don.id_sp = san_pham.id_sp WHERE id_hd = $id_hd";
        return $this->pdo_query($sql);
    }
    public function huydon($id_hd){
        $sql = "UPDATE hoa_don SET trang_thai=0 WHERE id_hd = $id_hd";
        $this->pdo_execute($sql);
    }
    public function danhnhan($id_hd){
        $sql = "UPDATE hoa_don SET trang_thai=5 WHERE id_hd = $id_hd";
        $this->pdo_execute($sql);
    }
    public function load_thongke_donhang(){
        $sql = "SELECT 
        COUNT(hoa_don.id_hd) AS so_luong_ban, 
        MONTH(hoa_don.ngay_dat) AS month_of_year
        FROM hoa_don
        WHERE hoa_don.trang_thai = 5
        GROUP BY month_of_year
        ORDER BY month_of_year;";
        $listsanpham = $this->pdo_query($sql);
        return $listsanpham;
    }
    public function thongke_donhang(){
        $sql = "SELECT COUNT(DISTINCT(hoa_don.id_hd)) as tongdonhang,SUM(chi_tiet_hoa_don.gia_ban) as tongdoanhthu , SUM(chi_tiet_hoa_don.so_luong) as tongspban from chi_tiet_hoa_don INNER JOIN hoa_don on chi_tiet_hoa_don.id_hd = hoa_don.id_hd WHERE hoa_don.trang_thai = 5";
        return $this->pdo_query_one($sql);
    }
    public function thongke_donhang_theothang($thang){
        $sql = " SELECT SUM(chi_tiet_hoa_don.gia_ban) AS doanhthuthang, 
        MONTH(hoa_don.ngay_dat) AS month_of_year
        FROM chi_tiet_hoa_don inner join hoa_don on chi_tiet_hoa_don.id_hd = hoa_don.id_hd 
        WHERE hoa_don.trang_thai = 5 and MONTH(hoa_don.ngay_dat) = $thang";
        return $this->pdo_query_one($sql);
    }
    public function san_pham_ban_chay(){
        $sql = "SELECT cthd.id_sp as id_sp, sp.ten_sp as ten_sp, SUM(cthd.so_luong) as so_luong_ban, SUM(cthd.gia_ban) as doanh_thu FROM chi_tiet_hoa_don as cthd INNER JOIN san_pham as sp on cthd.id_sp = sp.id_sp INNER JOIN hoa_don as hd on cthd.id_hd = hd.id_hd WHERE hd.trang_thai = 5 GROUP BY cthd.id_sp ORDER BY doanh_thu desc LIMIT 0,5";
        return $this->pdo_query($sql);
    }

    public function tong_trang(){
        $sql = "SELECT COUNT(*) as tongrecord FROM hoa_don";
        return $this->pdo_query_one($sql);
    }
}