<?php 
$dsn="mysql:host=114.215.170.242;dbname=baby";
$user='shequjia';
$password='shequjia102030';
try {
    $pdo = new PDO($dsn, $user, $password); 
    $pdo->query('set names utf8');
    //echo "yes";
} catch (PDOException $e) {
    die('连接数据库失败!');    
}
?>
