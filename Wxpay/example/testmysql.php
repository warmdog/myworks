<?php 
$dsn="mysql:host=121.41.128.207;dbname=wxpay";
$user='zhangmin';
$password='shequjia123456';
try {
    $pdo = new PDO($dsn, $user, $password); 
    $pdo->query('set names utf8');
    //echo "yes";
} catch (PDOException $e) {
    die('连接数据库失败!');    
}
?> 