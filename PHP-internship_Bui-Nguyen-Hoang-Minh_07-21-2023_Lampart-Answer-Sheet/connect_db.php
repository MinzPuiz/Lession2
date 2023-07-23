<?php

// tạo các biến lưu trữ thông tin về máy chủ cơ sở dữ liệu để tiến hành kết nối.
$host = 'localhost';
$dbname = 'category_management';
$username = 'root';
$password = '';

// sử dụng cấu trúc TRY và CATCH để xử lý nếu có lỗi xảy ra.
try{
    $connection = new PDO("mysql:host=$host; dbname=$dbname", $username, $password); // tạo một đối tượng kết nối PDO mới đến MySQL
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // đặt chế độ xử lý lỗi của PDO
} catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

?>