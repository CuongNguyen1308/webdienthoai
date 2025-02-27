<?php

namespace App\Models;

use PDO;

class db
{
    //tạo kết nối với CSDL
    public function getConnect()
    {
        $connect = new PDO(
            "mysql:host=" . SVNAME
                . ";dbname=" . DBNAME,
            USERNAME,
            PASSWORD
        );

        return $connect;
    }

    //lấy dữ liệu từ trong CSDL, nhận tham số đầu vào 
    //là câu truy vấn SQL
    public function pdo_query($sql, $params = [])
    {
        $conn = $this->getConnect(); //khởi tạo kết nối vs CSDL
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
    public function pdo_query_one($sql){
        $conn = $this->getConnect(); //khởi tạo kết nối vs CSDL
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }
    public function pdo_execute($sql){
        $conn = $this->getConnect(); //khởi tạo kết nối vs CSDL
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}
